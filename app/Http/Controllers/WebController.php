<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hotel;
use App\User;
use Illuminate\Foundation\Console\Presets\React;
use App\Room;
use App\Rate;
use App\Booking;
use Illuminate\Support\Facades\DB;

class WebController extends Controller
{
    protected $data = [];
    public function __construct(Request $request)
    {
        $this->middleware(function ($request, $next) {
            $user_id = $request->session()->get('user_id');
            $this->data['user'] = User::find($user_id);
            $this->data['start'] = $request->start;
            $this->data['end'] = $request->end;
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        return view('index', $this->data);
    }

    public function login(Request $request)
    {
        $this->data['path'] = $request->path;
        return view('login', $this->data);
    }

    public function register(Request $request)
    {
        $this->data['path'] = $request->path;
        return view('register', $this->data);
    }

    public function search(Request $request)
    {
        if($request->location == null)
            $request->location = 1;
        $hotels = Hotel::where('longitude', $request->location)->get();
        $this->data['hotels'] = $hotels->map(function ($hotel) {
            $stars = $hotel->rates()->count();
            return [
                'id' => $hotel->id,
                'name' => $hotel->name,
                'address' => $hotel->address,
                'avatar' => $hotel->images()->first() ? $hotel->images()->first()->url : 'https://images.unsplash.com/photo-1492455417212-e162ed4446e1?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=e8bd81d8bc531873ab3af61d83ef0c19&auto=format&fit=crop&w=1950&q=80',
                'price_min' => $hotel->rooms()->min('price'),
                'price_max' => $hotel->rooms()->max('price'),
                'total' => $hotel->rooms()->sum('total'),
                'services' => $hotel->services->map(function ($service) {
                    return [
                        'name' => $service->name
                    ];
                }),
                'stars' => $stars > 0 ? ceil(2 * ($hotel->rates()->sum('stars')) / $stars) / 2 : 5
            ];
        });
        return view('search', $this->data);
    }

    public function hotelRoom($hotelId, Request $request)
    {
        $hotel = Hotel::find($hotelId);
        $this->data['rooms'] = $hotel->rooms->map(function ($room) {
            return [
                'id' => $room->id,
                'name' => $room->name,
                'price' => $room->price,
                'total' => $room->total,
                'avatar' => count(json_decode($room->images)) == 0 ? 'https://www.rd.com/wp-content/uploads/2017/11/Here%E2%80%99s-What-You-Can-and-Can%E2%80%99t-Steal-from-Your-Hotel-Room_363678794-Elnur-760x506.jpg' : json_decode($room->images)[0],
                'features' => $room->features->map(function ($feature) {
                    return [
                        'name' => $feature->name
                    ];
                })
            ];
        });
        $this->data['hotel'] = [
            'name' => $hotel->name,
            'address' => $hotel->address,
            'images' => $hotel->images,
            'description' => $hotel->description,
            'images' => $hotel->images,
            'contact' => User::find(DB::table('hotel_modifier')->where('hotel_id', $hotel->id)->first()->user_id)->email
        ];

        if ($this->data['user'] == null)
            $this->data['isRated'] = false;
        else {
            $rate = Rate::where('user_id', $this->data['user']->id)->where('hotel_id', $hotel->id)->first();
            if ($rate == null)
                $this->data['isRated'] = false;
            else $this->data['isRated'] = true;
        }
        $this->data['hotel_id'] = $hotelId;
        $rates = Rate::join('users', 'rates.user_id', '=', 'users.id')->where('rates.hotel_id', $hotel->id)->select('rates.*', 'users.name')->get();
        $this->data['rates'] = $rates->map(function ($rate) {
            return [
                'id' => $rate->id,
                'name' => $rate->name,
                'content' => $rate->content,
                'stars' => $rate->stars,
            ];
        });
        return view('hotel-rooms', $this->data);
    }

    public function booking($roomId, Request $request)
    {
        $room = Room::find($roomId);
        if ($room == null)
            return $this->search($request);
        $this->data['room_id'] = $room->id;
        $this->data['name'] = $room->name;
        $this->data['price'] = $room->price;
        $this->data['features'] = $room->features;
        $this->data['hotel_name'] = $room->hotel->name;
        return view('booking', $this->data);
    }

    public function profile(Request $request)
    {
        $user = $this->data['user'];
        if($user == null)
            return $this->index($request);
        $bookings = $user->bookings;
        $this->data['bookings'] = $bookings->map(function($booking){
            $room = Room::find($booking->room_id);
            return [
                'id' => $booking->id,
                'hotel_name' => $room->hotel->name, 
                'room_name' => $room->name,
                'start' => $booking->start,
                'finish' => $booking->finish,
                'image_url' => json_decode($room->images)[0]
            ];
        }); 
        return view('profile', $this->data);
    }

    public function logout(Request $request)
    {
        $request->session()->put('user_id', 0);
        return $this->success(['message' => "success"]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hotel;
use App\User;
use Illuminate\Foundation\Console\Presets\React;
use App\Room;
use App\Rate;


class WebController extends Controller
{
    protected $data = [];
    public function __construct(Request $request)
    {
        $this->middleware(function ($request, $next) {
            $user_id = $request->session()->get('user_id');
            if ($user_id == null)
                $this->data['user'] = null;
            else
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
        $hotels = Hotel::all();
        $this->data['hotels'] = $hotels->map(function ($hotel) {
            $stars = $hotel->rates()->count();
            return [
                'id' => $hotel->id,
                'name' => $hotel->name,
                'avatar' => $hotel->images()->first() ? $hotel->images()->first()->url : 'https://images.unsplash.com/photo-1492455417212-e162ed4446e1?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=e8bd81d8bc531873ab3af61d83ef0c19&auto=format&fit=crop&w=1950&q=80',
                'price_min' => $hotel->rooms()->min('price'),
                'price_max' => $hotel->rooms()->max('price'),
                'total' => $hotel->rooms()->sum('total'),
                'services' => $hotel->services->map(function ($service) {
                    return [
                        'name' => $service->name
                    ];
                }),
                'stars' => $stars > 0 ? ceil(2*($hotel->rates()->sum('stars')) / $stars)/2 : 5
            ];
        });
        // dd($this->data['hotels']);
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
                'avatar' => json_decode($room->images)[0],
                'features' => $room->features->map(function ($feature) {
                    return [
                        'name' => $feature->name
                    ];
                })
            ];
        });
        $this->data['hotel_id'] = $hotelId;
        $rates = Rate::join('users', 'rates.user_id', '=', 'users.id')->where('rates.hotel_id', $hotel->id)->select('rates.*', 'users.name')->get();
        $this->data['rates'] = $rates->map(function($rate){
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
}

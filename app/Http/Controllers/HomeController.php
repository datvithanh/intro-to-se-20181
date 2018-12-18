<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Hotel;
use App\Feature;
use App\Service;
use App\HotelService;
use App\RoomFeature;
use App\Room;
use App\Booking;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $data['hotels'] = $user->hotels->map(function ($hotel) {
            return [
                'id' => $hotel->id,
                'name' => $hotel->name,
                'address' => $hotel->address,
                'description' => $hotel->description,
                'avatar' => $hotel->images()->first() ? $hotel->images()->first()->url : 'https://www.rd.com/wp-content/uploads/2017/11/Here%E2%80%99s-What-You-Can-and-Can%E2%80%99t-Steal-from-Your-Hotel-Room_363678794-Elnur-760x506.jpg',
            ];
        });
        return view('home', $data);
    }

    public function hotel($hotelId, Request $request)
    {
        $data = [];
        $hotel = Hotel::find($hotelId);
        if ($hotel == null)
            return redirect('/not-found');
        
        $stars = $hotel->rates()->count();

        $data['hotel'] = [
            'id' => $hotel->id,
            'name' => $hotel->name,
            'address' => $hotel->address,
            'description' => $hotel->description,
            'images' => $hotel->images,
            'stars' => $stars > 0 ? ceil(2 * ($hotel->rates()->sum('stars')) / $stars) / 2 : 5
        ];
        $data['rooms'] = $hotel->rooms()->orderBy('created_at', 'asc')->get()->map(function ($room) {
            return [
                'id' => $room->id,
                'name' => $room->name,
                'price' => $room->price,
                'total' => $room->total,
                'avatar' => count(json_decode($room->images)) == 0 ? 'https://www.rd.com/wp-content/uploads/2017/11/Here%E2%80%99s-What-You-Can-and-Can%E2%80%99t-Steal-from-Your-Hotel-Room_363678794-Elnur-760x506.jpg' : json_decode($room->images)[0],
            ];
        });
        return view('hotel', $data);
    }

    public function createHotel()
    {
        $data = [];
        $data['services'] = Service::all()->map(function ($service) {
            return [
                'id' => $service->id,
                'name' => $service->name,
            ];
        });
        return view('create-hotel', $data);
    }

    public function createRoom(Request $request)
    {
        $data = [];
        $data['features'] = Feature::all()->map(function ($feature) {
            return [
                'id' => $feature->id,
                'name' => $feature->name,
            ];
        });
        $data['hotel_id'] = $request->hotel_id;
        return view('create-room', $data);
    }

    public function hotelBooking($hotelId, Request $request)
    {
        $hotel = Hotel::find($hotelId);
        $data['hotel'] = $hotel;
        $roomIds = $hotel->rooms()->pluck('id')->toArray();
        $bookings = Booking::join('users', 'bookings.user_id', '=', 'users.id')
            ->join('rooms', 'rooms.id', '=', 'bookings.room_id')
            ->where('rooms.hotel_id', $hotelId)
            ->select(DB::raw('bookings.*,users.name as user_name,rooms.name as room_name, users.email as user_email, rooms.images as images, rooms.price as price'))
            ->orderBy('start', 'desc')
            ->get();
        $data['bookings'] = $bookings->map(function ($booking) {
            return [
                'id' => $booking->id,
                'user_id' => $booking->user_id,
                'start' => $booking->start,
                'finish' => $booking->finish,
                'price' => $booking->price,
                'room_name' => $booking->room_name,
                'user_name' => $booking->user_name,
                'user_email' => $booking->user_email,
                'created_at' => date_format($booking->created_at, 'i:H d-m-Y'),
                'done' => strtotime(date('Y-m-d')) >= strtotime($booking->finish),
            ];
        });

        return view('hotel-booking', $data);
    }

    public function editHotel($hotelId)
    {
        $data = [];
        $hotel = Hotel::find($hotelId);

        $data['services'] = Service::all()->map(function ($service) use ($hotel) {
            return [
                'id' => $service->id,
                'selected' => HotelService::where('hotel_id', $hotel->id)->where('service_id', $service->id)->first() ? 1 : 0,
                'name' => $service->name,
            ];
        });
        $data['id'] = $hotel->id;
        $data['name'] = $hotel->name;
        $data['address'] = $hotel->address;
        $data['description'] = $hotel->description;
        $data['images'] = $hotel->images;
        return view('edit-hotel', $data);
    }

    public function editRoom($roomId)
    {
        $data = [];
        $room = Room::find($roomId);

        $data['features'] = Feature::all()->map(function ($feature) use ($room) {
            return [
                'id' => $feature->id,
                'selected' => RoomFeature::where('room_id', $room->id)->where('feature_id', $feature->id)->first() ? 1 : 0,
                'name' => $feature->name,
            ];
        });
        $data['id'] = $room->id;
        $data['name'] = $room->name;
        $data['price'] = $room->price;
        $data['total'] = $room->total;
        $data['description'] = $room->description;
        $data['images'] = json_decode($room->images);
        $data['hotel_id'] = $room->hotel_id;
        return view('edit-room', $data);
    }
}

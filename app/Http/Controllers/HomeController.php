<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Hotel;
use App\Feature;
use App\Service;
use App\HotelService;

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
                'description' => $hotel->description
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
        $data['hotel'] = [
            'id' => $hotel->id,
            'name' => $hotel->name,
        ];
        $data['rooms'] = $hotel->rooms()->orderBy('created_at', 'asc')->get()->map(function ($room) {
            return [
                'id' => $room->id,
                'name' => $room->name,
                'price' => $room->price,
                'total' => $room->total
            ];
        });
        return view('hotel', $data);
    }

    public function createHotel()
    {
        $data = [];
        $data['services'] = Service::all()->map(function($service){
            return [
                'id' => $service->id,
                'name' => $service->name,
            ];
        });
        return view('create-hotel', $data);
    }
    
    public function editHotel($hotelId)
    {
        $data = [];
        $hotel = Hotel::find($hotelId);

        $data['services'] = Service::all()->map(function($service) use($hotel) {
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
        // dd($hotel->images);
        return view('edit-hotel', $data);
    }
}

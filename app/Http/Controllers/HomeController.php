<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Hotel;

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
        return view('create-hotel');
    }
}

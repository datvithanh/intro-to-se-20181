<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hotel;
use Illuminate\Support\Facades\Auth;
use App\Room;

class OwnerApiController extends ApiController
{
    public function __construct()
    {
    }

    public function createHotel(Request $request)
    {
        $user = Auth::user();
        $hotel = new Hotel();
        $hotel->name = $request->name;
        $hotel->address = $request->address;
        $hotel->description = $request->description;
        $hotel->save();
        $hotel->modifiers()->attach($user->id);
        return $this->success(["message" => "successs"]);
    }

    public function createRoom($hotelId, Request $request)
    {
        if(!Hotel::find($hotelId))
            return $this->badRequest(["message" => "Hotel id is invalid"]);
        $room = new Room();
        $room->hotel_id = $hotelId;
        $room->name = $request->name;
        $room->price = $request->price;
        $room->total = $request->total;
        $room->save(); 
        return $this->success(["message" => "success"]);
    }
}
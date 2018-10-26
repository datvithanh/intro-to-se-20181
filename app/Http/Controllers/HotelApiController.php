<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hotel;
use Illuminate\Support\Facades\Auth;

class HotelApiController extends ApiController
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
        // $kasdk = $user->name;
        // dd(json_decode($user));
        return $this->success(["message" => "successs"]);
    }
}
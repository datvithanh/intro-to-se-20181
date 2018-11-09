<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hotel;
use Illuminate\Support\Facades\Auth;
use App\Room;
use App\Image;
use App\HotelService;

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
        foreach ($request->services as $service_id) {
            $hotel->services()->attach($service_id);
        }
        // $image_urls = json_decode($request->image_urls);
        foreach ($request->image_urls as $url) {
            $image = new Image();
            $image->url = $url;
            $image->hotel_id = $hotel->id;
            $image->save();
        }
        return $this->success(["message" => "successs"]);
    }

    public function editHotel($hotelId, Request $request)
    {
        $hotel = Hotel::find($hotelId);
        $hotel->name = $request->name;
        $hotel->address = $request->address;
        $hotel->description = $request->description;
        $hotel->save();
        // dd($hotel->services);
        foreach (HotelService::where('hotel_id', $hotel->id)->get() as $service)
            $service->delete();
        foreach ($hotel->images as $image)
            $image->delete();

        foreach ($request->services as $service_id) {
            $hotel->services()->attach($service_id);
        }

        foreach ($request->image_urls as $url) {
            $image = new Image();
            $image->url = $url;
            $image->hotel_id = $hotel->id;
            $image->save();
        }
        return $this->success(["message" => "successs"]);
    }

    public function createRoom($hotelId, Request $request)
    {
        if (!Hotel::find($hotelId))
            return $this->badRequest(["message" => "Hotel id is invalid"]);
        $room = new Room();
        $room->hotel_id = $hotelId;
        $room->name = $request->name;
        $room->price = $request->price;
        $room->total = $request->total;
        $room->save();
        return $this->success(["message" => "success"]);
    }

    public function uploadImage(Request $request)
    {
        $urls = [];
        foreach (json_decode($request->image_names) as $name) {
            $newImageName = time() . $name;
            shell_exec('/var/www/mvimg ' . $name . ' ' . $newImageName);
            array_push($urls, "http://mywebsite.test/images/" . $newImageName);
        }
        return $this->success(["urls" => $urls]);
    }
}
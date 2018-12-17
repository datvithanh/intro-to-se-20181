<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hotel;
use Illuminate\Support\Facades\Auth;
use App\Room;
use App\Image;
use App\HotelService;
use App\RoomFeature;

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

    public function createRoom(Request $request)
    {
        $user = Auth::user();
        $room = new Room();
        $room->name = $request->name;
        $room->price = $request->price;
        $room->description = $request->description;
        $room->images = $request->image_urls;
        $room->hotel_id = $request->hotel_id;
        $room->total = $request->total;
        $room->save();
        foreach ($request->features as $feature_id) {
            $room->features()->attach($feature_id);
        }
        return $this->success(["message" => "success"]);
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

    public function editRoom($roomId, Request $request)
    {
        $room = Room::find($roomId);
        $room = new Room();
        $room->name = $request->name;
        $room->price = $request->price;
        $room->description = $request->description;
        $room->images = $request->image_urls;
        $room->hotel_id = $request->hotel_id;
        $room->total = $request->total;
        $room->save();
        foreach (RoomFeature::where('room_id', $room->id)->get() as $feature)
            $feature->delete();
        foreach ($request->features as $feature_id) {
            $room->features()->attach($feature_id);
        }
        return $this->success(["message" => "success"]);
    }

    public function deleteRoom($roomId)
    {
        $room = Room::find($roomId);
        foreach (RoomFeature::where('room_id', $room->id)->get() as $feature)
            $feature->delete();
        $room->delete();
        return $this->success(["message" => "success"]);
    }

    public function uploadImage(Request $request)
    {
        $urls = [];
        foreach (json_decode($request->image_names) as $name) {
            $newImageName = time() . $name;
            shell_exec('/var/www/mvimg ' . $name . ' ' . $newImageName);
            array_push($urls, "/" . "images" . "/" . $newImageName);
        }
        return $this->success(["urls" => $urls]);
    }
}
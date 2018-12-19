<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hotel;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Booking;
use App\Rate;
use Illuminate\Support\Facades\DB;
use App\HotelService;
use App\Image;
use App\Room;
use App\RoomFeature;

class ClientApiController extends ApiController
{

    public function __construct(Request $request)
    {
    }

    public function register(Request $request)
    {
        $email = $request->email;
        $name = $request->name;
        $password = $request->password;
        $user = User::where('email', $email)->first();
        if ($user)
            return $this->badRequest(['message' => 'duplicated email']);
        if (trim($name) == '' || $name == '')
            return $this->badRequest(['message' => 'missing name']);
        if (trim($password) == '' || $password == '')
            return $this->badRequest(['message' => 'missing password']);
        if (strlen($password) < 6)
            return $this->badRequest(['message' => 'password has at least 6 characters']);
        $user = new User();
        $user->email = $email;
        $user->name = $name;
        $user->password = bcrypt($password);
        $user->role = 'user';
        $user->save();
        $request->session()->put('user_id', $user->id);
        return $this->success(['message' => 'success']);
    }

    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        $user = User::where('email', $email)->first();
        if (!$user)
            return $this->badRequest(['message' => 'email does not exist']);
        if (!Hash::check($password, $user->password))
            return $this->badRequest(['message' => 'incorrect password']);
        if ($user->role == "Owner")
            return $this->badRequest(['message' => 'Owner backk ooffff']);
        $request->session()->put('user_id', $user->id);
        return $this->success(['message' => 'success']);
            // return ['aksdk' => 'asdkkad'];
    }

    public function logout(Request $request)
    {
        // $request->session()->forget('user_id');
        $request->session()->flush();
        return $this->success(['message' => "success"]);
    }

    public function booking($roomId, Request $request)
    {
        $user_id = $request->session()->get('user_id');
        $start = $request->start;
        $end = $request->end;
        $booking = new Booking();
        $booking->user_id = $user_id;
        $booking->start = $start;
        $booking->finish = $end;
        $booking->room_id = $roomId;
        $booking->save();
        return $this->success(["message" => "Đặt phòng thành công"]);
    }

    public function rate($hotelId, Request $request)
    {
        $rate = new Rate();
        $rate->hotel_id = $hotelId;
        $rate->user_id = $request->session()->get('user_id');
        $rate->stars = $request->stars;
        $rate->content = $request->content;
        $rate->save();
        return $this->success(['message' => 'success']);
    }

    public function test(Request $request)
    {
        dd(Hotel::max('id'));
    }
}

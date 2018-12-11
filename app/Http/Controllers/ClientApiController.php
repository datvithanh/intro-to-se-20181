<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hotel;
use App\User;
use Illuminate\Support\Facades\Hash;

class ClientApiController extends ApiController
{

    public function __construct(Request $request)
    {
        // $this->user_id = $request->session()->get('user_id');
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

    //axios.get('/api/test').then(function(response){console.log(response)}).catch(function(){})

    public function test(Request $request)
    {
        // dd($request->session()->get('user_id'));
        return ['data' => $request->session()->get('user_id')];
    }
}

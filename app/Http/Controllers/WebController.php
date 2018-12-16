<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hotel;
use App\User;
use Illuminate\Foundation\Console\Presets\React;


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

            return $next($request);
        });
    }

    public function index(Request $request)
    {
        return view('index', $this->data);
    }

    public function login(Request $request)
    {
        return view('login', $this->data);
    }

    public function register(Request $request)
    {
        return view('register', $this->data);
    }

    public function search(Request $request)
    {
        $hotels = Hotel::all();
        $this->data['hotels'] = $hotels->map(function ($hotel) {
            return [
                'id' => $hotel->id,
                'name' => $hotel->name,
                'avatar' => $hotel->images()->first() ? $hotel->images()->first()->url : 'https://images.unsplash.com/photo-1492455417212-e162ed4446e1?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=e8bd81d8bc531873ab3af61d83ef0c19&auto=format&fit=crop&w=1950&q=80',
            ];
        });
        return view('search', $this->data);
    }
}

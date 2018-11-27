<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hotel;


class WebController extends Controller
{

    public function __construct()
    {
        $this->data = [];
    }

    public function index()
    {
        return view('index');
    }

    public function search(Request $request)
    {
        $hotels = Hotel::all();
        $this->data['hotels'] = $hotels->map(function($hotel){
            return [
                'id' => $hotel->id,
                'name' => $hotel->name,
                'avatar' => $hotel->images()->first() ? $hotel->images()->first()->url : 'https://images.unsplash.com/photo-1492455417212-e162ed4446e1?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=e8bd81d8bc531873ab3af61d83ef0c19&auto=format&fit=crop&w=1950&q=80',
            ];
        });
        return view('search', $this->data);
    }
}

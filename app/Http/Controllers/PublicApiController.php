<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PublicApiController extends ApiController
{
    public function __construct()
    {
    }

    public function uploadImage(Request $request)
    {
        // $image = $request->file('image');
        // if ($image == null)
        //     return $this->badRequest(["message" => "Chua gui anh"]);
        // if ($image->guessClientExtension() == 'png')
        //     $imageFileName = time() . rand(15, true) . '.png';
        // else
        //     $imageFileName = time() . rand(15, true) . '.jpg';
        // $path = Storage::disk('public')->put('images', $image);
        // return $this->success(['url' => config('app.app_url') . '/' . $path]);
    }
}
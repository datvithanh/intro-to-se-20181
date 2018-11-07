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
        // dd(json_decode($request->image_names));
        // dd($request->image_names);
        $urls = [];
        foreach (json_decode($request->image_names) as $name) {
            $newImageName = time() . $name;
            shell_exec('/var/www/mvimg ' . $name . ' ' . $newImageName);
            array_push($urls, "http://mywebsite.test/images/" . $newImageName);
        }
        return $this->success(["urls" => $urls]);
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
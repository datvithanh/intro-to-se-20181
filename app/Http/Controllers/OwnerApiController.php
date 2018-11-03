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
        foreach ($request->services as $service_id) {
            $hotel->services()->attach($service_id);
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

    public function upload_image(Request $request)
    {
        $size = $request->size;
        $old_name = $request->old_name;
        $thumb_size = $request->thumb_size;
        $old_thumb_name = $request->old_thumb_name;
        $data = ['type' => 'image'];
        $image_name = uploadFileToS3($request, 'image', $size, $old_name);
        if ($image_name != null) {
            $data['image_url'] = generate_protocol_url($this->s3_url . $image_name);
            $data['image_name'] = $image_name;
        }
        if ($thumb_size) {
            $thumb_name = uploadThunbImageToS3($request, 'image', $thumb_size, $old_thumb_name);
            if ($thumb_name != null) {
                $data['thumb_name'] = $thumb_name;
                $data['thumb_url'] = generate_protocol_url($this->s3_url . $thumb_name);
            }
        }

        $data['message'] = 'Tải lên thành công';
        $data['size'] = $size;
        $data['thumb_size'] = $thumb_size;
        return $this->respond($data);
    }

//     function uploadFileToS3(\Illuminate\Http\Request $request, $fileField, $size, $oldfile = null)
//     {
//         $image = $request->file($fileField);

//         if ($image != null) {
//             $mimeType = $image->guessClientExtension();
//             $s3 = \Illuminate\Support\Facades\Storage::disk('s3');


//             if ($mimeType != 'image/gif') {
//                 $imageFileName = time() . random(15, true) . '.jpg';
//                 $img = Image::make($image->getRealPath())->encode('jpg', 90)->interlace();
//                 if ($img->width() > $size) {
//                     $img->resize($size, null, function ($constraint) {
//                         $constraint->aspectRatio();
//                     });
//                 }
//                 $img->save($image->getRealPath());
//             } else {
//                 $imageFileName = time() . random(15, true) . '.' . $image->getClientOriginalExtension();
//             }
//             $filePath = '/images/' . $imageFileName;
//             $s3->getDriver()->put($filePath, fopen($image, 'r+'), ['ContentType' => $mimeType, 'visibility' => 'public']);
// //        if ($oldfile != null) {
// //            $s3->delete($oldfile);
// //        }
//             return $filePath;
//         }
//         return null;
//     }
}
<?php

namespace App\Traits;

use Image;
use Illuminate\Support\Facades\Storage;
use Throwable;

trait Uploadable
{
    public function createThumbnail($path, $width, $height, $save_path)
    {
        $img = Image::make($path)->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($save_path);
    }

    public function resizeImage($file, $fileNameToStore, $width, $height,$ext)
    {
        try {


            // Resize image
            $resize = Image::make($file)->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            })->encode('jpg');


            // Create hash value
//            $hash = md5($resize->__toString());

            // Prepare qualified image name
//            $image = $hash . '.'. $ext;

            // Put image to storage
            $save = \Storage::disk('local')->put("/uploads/".$fileNameToStore, $resize->__toString());

//            $save = Storage::disk('local')->put("/uploads/{$fileNameToStore}", $resize->__toString());

            if ($save) {
                return true;
            }

        } catch (Throwable $ex) {
            $save = \Storage::disk('local')->put("/uploads/".$fileNameToStore, $file);

            if($save) {
                return true;
            }
//            \Image::make($file)->save(public_path('uploads/') . $fileNameToStore);

//            throw $ex;
            return false;

        }
    }
}

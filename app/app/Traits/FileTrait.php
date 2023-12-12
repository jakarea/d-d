<?php

namespace App\Traits;


use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

trait FileTrait
{
    protected function fileUpload($base64Image, $destinationPath)
    {

        if (!Storage::disk('public')->exists($destinationPath)) {
            Storage::disk('public')->makeDirectory($destinationPath);
        }

        list($type, $base64Image) = explode(';', $base64Image);
        list(, $base64Image) = explode(',', $base64Image);
        $imageData = base64_decode($base64Image);

        // Generate a unique filename
        $fileName = Carbon::now()->toDateString() . '-' . uniqid() . '.png';

        // Store the image in the storage/app/public directory
        Storage::disk('public')->put($destinationPath . '/' . $fileName, $imageData);

        return $fileName;
    }

    public function deleteFile($directory, $arrayofImages)
    {

        $fileUrl = Config::get('app.file_url');

        foreach ($arrayofImages as $image) {
            $image = str_replace($fileUrl, "", $image);
            if (Storage::disk($directory)->exists($image)) {
                Storage::disk($directory)->delete($image);
            }
        }
    }

}

<?php

namespace App\Traits;


use Carbon\Carbon;
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
        $fileName = Carbon::now()->toDateString() . '-' . uniqid() . '-' . '.png';

        // Store the image in the storage/app/public directory
        Storage::disk('public')->put($destinationPath . '/' . $fileName, $imageData);

        // Get the path to the stored image
        $filePath = Storage::url($fileName);

        return $filePath;
    }

}

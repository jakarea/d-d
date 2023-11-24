<?php

namespace App\Traits;


use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

trait FileTrait
{
    protected function fileUpload($request, $inputName, $destinationPath)
    {
        if ($request->hasFile($inputName)) {

            if (!Storage::exists($destinationPath)) {
                Storage::makeDirectory($destinationPath);
            }

            $file = $request->file($inputName);
            $fileName = Carbon::now()->toDateString() . '-' . uniqid() . '-' . $file->getClientOriginalName();
            $filePath = $request->file($inputName)->storeAs($destinationPath, $fileName);

            return $fileName;
        }
    }

    protected function fileDelete()
    {
        //
    }
}

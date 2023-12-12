<?php

namespace App\Process;

use App\Models\ProductVarient;
use App\Traits\FileTrait;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

class ProductVarientProcess
{

    use FileTrait;

    public static function create($request)
    {
        $productVarient = new ProductVarient();
        $productVarient = (new self())->saveProductVarient($request, $productVarient);

        return $productVarient;
    }

    public static function update($request, $id)
    {
        $productVarient =  ProductVarient::find($id);

        if (isset($request['images']) && count($request['images']) > 0 && isset($productVarient->images)) {
            $arrayofImages = json_decode($productVarient->images);
            (new self())->deleteImage($arrayofImages);
        }

        $productVarient = (new self())->saveProductVarient($request, $productVarient);

        return $productVarient;
    }

    public function saveProductVarient($request, $productVarient)
    {

        $productVarient->user_id = auth()->user()->id;
        $productVarient->company_id = isset($request['company_id']) ? $request['company_id']:null;
        $productVarient->product_id = isset($request['product_id']) ? $request['product_id']:null;
        $productVarient->title = isset($request['title']) ? $request['title']:null; 
        $productVarient->price = isset($request['price']) ? $request['price']:null;
        $productVarient->sell_price = isset($request['sell_price']) ? $request['sell_price']:null;
        $productVarient->cupon = isset($request['cupon']) ? $request['cupon']:null;
        $productVarient->description = isset($request['description']) ? $request['description']:null;

        if (isset($request['images']) && count($request['images']) > 0) {
            $arrayofImage =  $this->saveImage($request);
            $productVarient->images  = json_encode($arrayofImage);
        }

        $productVarient->save();

        return $productVarient;
    }

    public function saveImage($request)
    {
        $arrayofImages = [];

        foreach ($request['images'] as $image) {
            $filePath = $this->fileUpload($image, "product-varients");
            $arrayofImages[] = asset('storage/product-varients/' . $filePath);
        }

        return $arrayofImages;
    }

    public function deleteImage($arrayofImages)
    {

        $fileUrl =  Config::get('app.file_url');
        foreach ($arrayofImages as $image){
            $image = str_replace($fileUrl, "", $image);
            Storage::disk('public')->delete($image);
        }
    }




}

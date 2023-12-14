<?php

namespace App\Process;

use App\Models\ProductVariant;
use App\Traits\FileTrait;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

class ProductVariantProcess
{

    use FileTrait;

    public static function create($request)
    {
        $ProductVariant = new ProductVariant();
        $ProductVariant = (new self())->saveProductVariant($request, $ProductVariant);

        return $ProductVariant;
    }

    public static function update($request, $id)
    {
        $ProductVariant =  ProductVariant::find($id);

        if (isset($request['images']) && count($request['images']) > 0 && isset($ProductVariant->images)) {
            $arrayofImages = json_decode($ProductVariant->images);
            (new self())->deleteImage($arrayofImages);
        }

        $ProductVariant = (new self())->saveProductVariant($request, $ProductVariant);

        return $ProductVariant;
    }

    public function saveProductVariant($request, $ProductVariant)
    {

        $ProductVariant->user_id = auth()->user()->id;
        $ProductVariant->company_id = isset($request['company_id']) ? $request['company_id']:null;
        $ProductVariant->product_id = isset($request['product_id']) ? $request['product_id']:null;
        $ProductVariant->title = isset($request['title']) ? $request['title']:null; 
        $ProductVariant->price = isset($request['price']) ? $request['price']:null;
        $ProductVariant->sell_price = isset($request['sell_price']) ? $request['sell_price']:null;
        $ProductVariant->cupon = isset($request['cupon']) ? $request['cupon']:null;
        $ProductVariant->description = isset($request['description']) ? $request['description']:null;

        if (isset($request['images']) && count($request['images']) > 0) {
            $arrayofImage =  $this->saveImage($request);
            $ProductVariant->images  = json_encode($arrayofImage);
        }

        $ProductVariant->save();

        return $ProductVariant;
    }

    public function saveImage($request)
    {
        $arrayofImages = [];

        foreach ($request['images'] as $image) {
            $filePath = $this->fileUpload($image, "product-variants");
            $arrayofImages[] = asset('storage/product-variants/' . $filePath);
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

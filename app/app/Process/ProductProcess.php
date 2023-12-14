<?php

namespace App\Process;

use App\Http\Requests\Product\UpdateRequest;
use App\Models\Product;
use App\Traits\FileTrait;
use App\Traits\SlugTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

class ProductProcess
{
    use SlugTrait, FileTrait;

    public static function create($request)
    {
        $product = new Product();
        $product = (new self())->saveProduct($request, $product);

        return $product;
    }

    public static function update($request, $productId)
    {
        $product = Product::find($productId);

        if (isset($request->images) && count($request->images) > 0 && isset($product->images)) {
            $arrayofImages = json_decode($product->images);
            (new self())->deleteImage($arrayofImages);
        }

        $product = (new self())->saveProduct($request, $product);

        return $product;
    }

    public function saveProduct($request, $product)
    { 

        $product->user_id = auth()->user()->id;
        $product->company_id = $request->company_id;
        $product->title = $request->title;
        $product->slug = $this->makeUniqueSlug($request->title,'Product');
        $product->cats = json_encode($request->cats);
        $product->product_url = $request->product_url;
        $product->price = $request->price;
        $product->sell_price = $request->sell_price;
        $product->cupon = $request->cupon;
        $product->description = $request->description;

        if (isset($request->images) && count($request->images) > 0) {
            $arrayofImage =  $this->saveImage($request);
            $product->images = json_encode($arrayofImage);
        }

        $product->save();

        return $product;
    }

    public function saveImage($request)
    {
        $arrayofImages = [];

        foreach ($request->images as $image) {
            $filePath = $this->fileUpload($image, "product");
            $arrayofImages[] = asset('storage/product/' . $filePath);
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

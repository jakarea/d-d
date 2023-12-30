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

        if (!empty($product)) {
            if (isset($request->images) && count($request->images) > 0 && isset($product->images)) {
                (new self())->deleteImage($product->images);
            }
    
            $product = (new self())->saveProduct($request, $product);
    
            return $product;
        } else { 
            return null;
        }
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
            $imageString = $this->saveImage($request);
            $product->images = $imageString;
            $product->save(); 
        }

        $product->save();

        return $product;
    }

    public function saveImage($request)
    {
        $imageString = '';
        foreach ($request->images as $image) {
            $filePath = $this->fileUpload($image, "product"); 
            $imageUrl = asset(Storage::url("product/{$filePath}"));
            $imageString .= $imageUrl . ',';
        }

        $imageString = rtrim($imageString, ',');

        return $imageString;
    }

    public function deleteImage($imageString)
    {
        $fileUrl = Config::get('app.file_url');
         
        $arrayofImages = explode(',', $imageString);

        foreach ($arrayofImages as $image) { 
            $image = str_replace($fileUrl, "", $image); 
            Storage::disk('public')->delete($image);
        }
    }


}

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
        $productVariant = ProductVariant::find($id);

        // Delete existing images if any
        if (isset($request['images']) && count($request['images']) > 0 && isset($productVariant->images)) {
            (new self())->deleteImage($productVariant->images);
        }

        // Update product variant with new data and images
        $productVariant = (new self())->saveProductVariant($request, $productVariant);

        return $productVariant;
    }

    public function saveProductVariant($request, $productVariant)
    {
        $productVariant->user_id = auth()->user()->id;
        $productVariant->company_id = $request['company_id'] ?? null;
        $productVariant->product_id = $request['product_id'] ?? null;
        $productVariant->title = $request['title'] ?? null; 
        $productVariant->price = $request['price'] ?? null;
        $productVariant->sell_price = $request['sell_price'] ?? null;
        $productVariant->cupon = $request['cupon'] ?? null;
        $productVariant->description = $request['description'] ?? null;

        // Save images as a comma-separated string
        if (isset($request['images']) && count($request['images']) > 0) {
            $imageString = $this->saveImage($request);
            $productVariant->images = $imageString;
        }

        $productVariant->save();

        return $productVariant;
    }

    public function saveImage($request)
    {
        $imageString = '';

        foreach ($request['images'] as $image) {
            $filePath = $this->fileUpload($image, "product-variants");
            $imageString .= asset('storage/product-variants/' . $filePath) . ',';
        }

        // Remove the trailing comma
        $imageString = rtrim($imageString, ',');

        return $imageString;
    }

    public function deleteImage($imageString)
    {
        $fileUrl = Config::get('app.file_url');

        // Convert the comma-separated string to an array
        $arrayofImages = explode(',', $imageString);

        foreach ($arrayofImages as $image) {
            $image = str_replace($fileUrl, "", $image);
            Storage::disk('public')->delete($image);
        }
    }
}
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

            // if product has only old images
            if (isset($request->images) && count($request->images) > 0 && $request->new_images == null) {

                $existingImages = (new self())->updateOldImage($product, $request);
                $product->images = implode(',', $existingImages);
                $product->save();

            } // if product has only new images
            elseif (isset($request->new_images) && count($request->new_images) > 0 && $request->images == null) {

                $imageString = (new self())->saveImage($request->new_images);
                $product->images = $imageString;
                $product->save();

            } // if product has both new and old images
            elseif (isset($request->images) && count($request->images) > 0 && isset($request->new_images) && count($request->new_images) > 0) {
                // Update existing images
                $existingImages = (new self())->updateOldImage($product, $request);

                // Add new images
                $imageString = (new self())->saveImage($request->new_images);

                $newImages = is_array($imageString) ? $imageString : explode(',', $imageString);
                $allImages = array_merge($existingImages, $newImages);
                $product->images = implode(',', $allImages);
                $product->save();

            }

            $product = (new self())->saveProduct($request, $product);

            return $product;
        } else {
            return null;
        }
    }

    // save product
    public function saveProduct($request, $product)
    {

        $product->user_id = auth()->user()->id;
        $product->company_id = $request->company_id;
        $product->title = $request->title;
        $product->slug = $this->makeUniqueSlug($request->title, 'Product');
        $product->cats = json_encode($request->cats);
        $product->product_url = $request->product_url;
        $product->price = $request->price;
        $product->sell_price = $request->sell_price;
        $product->cupon = $request->cupon;
        $product->description = $request->description;
        $product->deal_type = $request->deal_type;
        $product->deal_expired_at = $request->deal_expired_at;
        $product->location_latitude = $request->location_latitude;
        $product->location_longitude = $request->location_longitude;

        // Check if status is present in the request and update it
        if (isset($request->status)) {
            $product->status = $request->status;
        }

        // Check if location is present in the request and update it
        if (isset($request->location)) {
            $product->location = $request->location;
        }
        // this is only for creating new product
        if (isset($request->images) && count($request->images) > 0) {
            $imageString = (new self())->saveImage($request->images);
            $product->images = $imageString;
            $product->save();
        }

        $product->save();

        return $product;
    }

    // update old image
    public function updateOldImage($product, $request)
    {
        $existingImages = explode(',', $product->images);
        $imagesToDelete = collect($existingImages)->filter(function ($image) use ($request) {
            return !in_array($image, $request->images ?? []);
        });

        // Log images to delete
        logger()->info('Images to delete:', $imagesToDelete->toArray());

        $this->deleteImage($imagesToDelete); // Delete old images

        // Remove deleted images from existing images array
        $existingImages = array_diff($existingImages, $imagesToDelete->toArray());

        return $existingImages;

    }

    // save new images and convert base 64 to string
    public function saveImage($images)
    {
        $imageString = '';
        foreach ($images as $image) {
            $filePath = $this->fileUpload($image, "product");
            $imageUrl = asset("public/storage/product/{$filePath}");
            $imageString .= $imageUrl . ',';
        }

        $imageString = rtrim($imageString, ',');

        return $imageString;
    }

    public function deleteImage($imagesToDelete)
    {
        $fileUrl = Config::get('app.file_url');

        foreach ($imagesToDelete as $image) {
            $imagePath = str_replace($fileUrl, "", $image);
            Storage::disk('public')->delete($imagePath);
        }
    }
}

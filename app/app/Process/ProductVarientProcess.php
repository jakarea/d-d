<?php

namespace App\Process;

use App\Models\ProductVarient;

class ProductVarientProcess
{

    public static function create($request)
    {
        $productVarient = new ProductVarient();

        $productVarient = (new self())->saveProductVarient($request, $productVarient);

        return $productVarient;
    }

    public function saveProductVarient($request, $productVarient)
    {

        $productVarient->user_id = auth()->user()->id;
        $productVarient->company_id = $request->company_id;
        $productVarient->product_id = $request->product_id;
        $productVarient->title = $request->title;
        $productVarient->cats = $request->cats;
        $productVarient->product_url = $request->product_url;
        $productVarient->price = $request->price;
        $productVarient->sell_price = $request->sell_price;
        $productVarient->cupon = $request->cupon;
        $productVarient->description = $request->description;
        $productVarient->images = $request->images;
        $productVarient->save();

        return $productVarient;
    }
}

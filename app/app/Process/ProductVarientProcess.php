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

    public static function update($request, $id)
    {
        $productVarient =  ProductVarient::find($id);
        $productVarient = (new self())->saveProductVarient($request, $productVarient);

        return $productVarient;
    }

    public function saveProductVarient($request, $productVarient)
    {

        $productVarient->user_id = auth()->user()->id;
        $productVarient->company_id = isset($request['company_id']) ? $request['company_id']:null;
        $productVarient->product_id = isset($request['product_id']) ? $request['product_id']:null;
        $productVarient->title = isset($request['title']) ? $request['title']:null;
        $productVarient->cats = isset($request['cats']) ? $request['cats']:null;
        $productVarient->product_url = isset($request['product_url']) ? $request['product_url']:null;
        $productVarient->price = isset($request['price']) ? $request['price']:null;
        $productVarient->sell_price = isset($request['sell_price']) ? $request['sell_price']:null;
        $productVarient->cupon = isset($request['cupon']) ? $request['cupon']:null;
        $productVarient->description = isset($request['description']) ? $request['description']:null;
        $productVarient->images = isset($request['images']) ? $request['images']:null;
        $productVarient->save();

        return $productVarient;
    }
}

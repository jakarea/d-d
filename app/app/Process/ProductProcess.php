<?php

namespace App\Process;

use App\Http\Requests\Product\UpdateRequest;
use App\Models\Product;

class ProductProcess{


      public static function update(UpdateRequest $request, $productId)
      {
          $product = Product::find($productId);

          $product->user_id = $request->user_id;
          $product->company_id = $request->company_id;
          $product->title = $request->title;
          $product->cats = $request->cats;
          $product->product_url = $request->product_url;
          $product->price = $request->price;
          $product->sell_price = $request->sell_price;
          $product->cupon = $request->cupon;
          $product->description = $request->description;
          $product->images = $request->images;
          $product->save();

          return $product;
      }
}

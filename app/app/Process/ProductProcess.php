<?php

namespace App\Process;

use App\Http\Requests\Product\UpdateRequest;
use App\Models\Product;

class ProductProcess{


      public static function create($request)
      {
          $product = new Product();
          $product = (new self())->saveProduct($request, $product);

          return $product;
      }

      public static function update(UpdateRequest $request, $productId)
      {
          $product = Product::find($productId);
          $product = (new self())->saveProduct($request, $product);

          return $product;
      }

      public function saveProduct($request, $product)
      {

          $product->user_id = auth()->user()->id;
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

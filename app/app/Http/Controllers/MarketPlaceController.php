<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Traits\SlugTrait;

class MarketPlaceController extends Controller
{
    use SlugTrait;
    //
    public function index()
    {
        $category = isset($_GET['category']) ? $_GET['category'] : '';
        $products = Product::with('reviews','company');

        $selectedCat = '';
        if (!empty($category)) {
            $selectedCat = Category::find($category);
        }

        if (!empty($category)) {
            $products->where('cats', 'like', '%' . $category . '%');
        }

        $products = $products->orderBy('id', 'desc')->paginate(16);
        $categories = Category::all();
 
        return view('marketplace/index',compact('products','categories','selectedCat'));
    }

    public function show($slug)
    {
        $product = Product::where('slug',$slug)->with('reviews','productVariants','company')->first();

        $productVariants = $product->productVariants;
        $company = $product->company;

        return view('marketplace/show',compact('product','productVariants','company'));
    }

    public function edit($slug)
    {
       $product = Product::where('slug',$slug)->with('reviews','productVariants','company')->first();
        return view('marketplace/edit',compact('product'));
    }

    public function update(Request $request, $slug)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'product_url' => 'url',
            'price' => 'numeric|min:0',
            'sell_price' => 'numeric|min:0',
            'description' => 'string|max:1000',
        ]);
 
        $product = Product::where('slug',$slug)->first();

        if (!$product) {
            return redirect('/dashboard');
        }

        // Update product details
        $product->title = $request->input('title');
        $product->product_url = $request->input('product_url');
        $product->price = $request->input('price');
        $product->sell_price = $request->input('sell_price');
        $product->description = $request->input('description');
 
        $product->slug = $this->makeUniqueSlug($request->input('title'), 'Product', $product->id);
        $product->save();

        // Redirect to the product index page
        return redirect()->route('product.list')->with('success', 'Product updated successfully!');
    }
}

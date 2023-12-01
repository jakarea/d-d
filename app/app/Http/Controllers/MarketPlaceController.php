<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Company;
use App\Models\User;

class MarketPlaceController extends Controller
{
    //
    public function index()
    {
        $category = isset($_GET['category']) ? $_GET['category'] : '';
        $products = Product::with('reviews');

        $selectedCat = $category;

        if ($category) {
            $products->where('cats', 'like', '%' . $category . '%')->orderBy('id', 'desc');
        }

        $products = $products->paginate(16);
        $categories = Category::all();
 
        return view('marketplace/index',compact('products','categories','selectedCat'));
    }

    public function show($slug)
    {
       $product = Product::where('slug',$slug)->with('reviews')->first();
        return view('marketplace/show',compact('product'));
    }
}

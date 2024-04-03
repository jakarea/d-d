<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    //

    public function index()
    {
        $products = [];
        $categories = Category::get();

        foreach ($categories as $category) { 
            $products[$category->id] = Product::where('cats', 'like', '%' . $category->id . '%')->get();
        }

        // return $products;

        return view('home/index',compact('categories','products'));
    }

    public function home()
    {
        return redirect('/');
    }
}

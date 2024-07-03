<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\PricingPackage;
use App\Models\Product;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    //
    // web package list
    public function packageList()
    {

        $packages = PricingPackage::with('myPurchaseInfo')
        ->where('status', 'active')->get();

        return view('packages/purchase', compact('packages'));
        
    }
    
    // main landing page
    public function index()
    {
        $products = [];
        $categories = Category::get();

        foreach ($categories as $category) {
            $products[$category->id] = Product::where('cats', 'like', '%' . $category->id . '%')
                ->where('status', 'Active')
                ->get();
        }

        return view('home/index', compact('categories', 'products'));
    }

    public function home()
    {
        return redirect('/');
    }

    // guest product list page
    public function productList()
    {
        $products = Product::where('status', 'Active')->paginate(12);
        return view('home/product-list', compact('products'));
    }

    // guest product details page
    public function productDetails($slug)
    {
        $product = Product::where('slug', $slug)->first();
        return view('home/product-details', compact('product'));
    }

    // terms condition pages
    public function privacyPolicy()
    {
        return view('home.privacy-policy');
    }

    public function termsCondition()
    {
        return view('home.terms-condition');
    }
    

}

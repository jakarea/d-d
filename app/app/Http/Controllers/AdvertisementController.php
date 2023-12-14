<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Company;
use App\Models\User;

class AdvertisementController extends Controller
{
    public function index()
    {
        $status = isset($_GET['status']) ? $_GET['status'] : '';
        $category = isset($_GET['category']) ? $_GET['category'] : '';
        $products = Product::with('reviews', 'company');

        $selectedCat = '';
        if (!empty($category)) {
            $selectedCat = Category::find($category);
            $products->where('cats', 'like', '%' . $category . '%');
        }

        $selectedStatus = '';
        if (!empty($status)) {
            $selectedStatus = $status;
            if ($status == 'Active') {
                $products->where('status', 1);
            } elseif ($status == 'Inactive') {
                $products->where('status', 0)->orWhereNull('status');
            }
        }

        $products->orderBy('id', 'desc');
        $products = $products->paginate(16);
        $categories = Category::all();

        return view('advertisement/index', compact('products', 'categories', 'selectedCat', 'selectedStatus'));

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index(){
        return view('package/plans');
    }

    public function editPackage(){
        return view('package/editPlans');
    }

    public function updatePackage(){
        return view('package/editPlans');
    }
}

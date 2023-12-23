<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Earning;

class EarningController extends Controller
{
    public function index(){
        $earnings = Earning::all();
        return view('earnings/index',compact('earnings'));
    }

    public function show(){
        return view('earnings/show');
    }
}
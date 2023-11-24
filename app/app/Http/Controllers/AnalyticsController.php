<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    public function analytics(){
        return view('dashboard/analytics');
    }

    public function index(){
        return view('dashboard/index');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\User;
use App\Models\PersonalInfo;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationMail;
use App\Models\Role;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Hash; 
use Carbon\Carbon;

class AnalyticsController extends Controller
{
    public function analytics(){

        // total users
        $totalUsersByMonths = [];
        $totalUsersByMonths = $this->getUserCountPerMonth(); 

        // total products
        $totalProducts = Product::count();

        return view('analytics/index',compact('totalUsersByMonths','totalProducts'));
    }

    // total user by months
    public function getUserCountPerMonth()
    {
        $userCounts = []; 
        $currentMonth = Carbon::now()->month; 
        for ($i = 0; $i < 12; $i++) {
            $month = ($currentMonth - $i) % 12;
            $month = $month == 0 ? 12 : $month; 
            $userCount = User::whereMonth('created_at', $month)
                ->whereYear('created_at', Carbon::now()->year)
                ->count(); 
            $userCounts[] = $userCount;
        }
        $userCounts = array_reverse($userCounts);

        return $userCounts;
    }
}

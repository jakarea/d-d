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

        // total and active draft products
        $totalProducts = Product::count();
        $activeProducts = 0;
        $draftProducts = 0;
        $products = Product::get();
        if ($products) {
            foreach ($products as $product) { 
                if ($product->status == 0) {
                    $draftProducts++;
                } elseif ($product->status == 1) {
                    $activeProducts++;
                }
            }
        }
 
        // company users
        $activeCompanyUsers = [];
        $activeCompanyUsers = $this->getTopActiveCompanyUsers();
        $activeInactiveCompanyUserCurrentMonth = [];
        $activeInactiveCompanyUserCurrentMonth = $this->getActiveInactiveCompanyUserbyMonth(); 

        return view('analytics/index',compact('totalUsersByMonths','totalProducts','activeProducts','draftProducts','activeCompanyUsers','activeInactiveCompanyUserCurrentMonth'));
    }

    // top active user by company
    public function getTopActiveCompanyUsers()
    {
        $usersWithCompanyRole = User::with('roles')
        ->whereHas('roles', function ($query) {
            $query->where('slug', 'company');
        })
        ->where('status',1)
        ->get();

        return $usersWithCompanyRole;
    }

    // total active inactive user by current month
    public function getActiveInactiveCompanyUserbyMonth()
    {
        $activeCountByDate = [];
        $inactiveCountByDate = [];

        $currentMonth = Carbon::now()->month;

        $activeCountByDate = User::where('status', '1')
            ->whereHas('roles', function ($query) {
                $query->where('slug', 'company');
            })
            ->whereMonth('created_at', $currentMonth)
            ->count();

        $inactiveCountByDate = User::where('status', NULL)
            ->whereHas('roles', function ($query) {
                $query->where('slug', 'company');
            })
            ->whereMonth('created_at', $currentMonth)
            ->count();


        return [$activeCountByDate, $inactiveCountByDate];
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\User;
use App\Models\Earning;     
use App\Models\Product; 
use Carbon\Carbon;

class AnalyticsController extends Controller
{
    public function analytics()
    {

        // total earnings
        $totalEarnings = Earning::whereIn('status', ['paid', 'expired'])
        ->pluck('amount')
        ->sum();

        // todays earning
        $today = Carbon::today();
        $todayEarnings = Earning::whereDate('start_at', $today)
        ->whereIn('status', ['paid', 'expired'])
        ->pluck('amount')
        ->sum();

        // total customer payment
        $totalCurrentPayment = Earning::where('status','paid')
        ->pluck('amount')
        ->sum();

        // total due amount
        $totalDueAmount = Earning::where('status','Pending')
        ->pluck('amount')
        ->sum();

        // today due amount 
        $todayDueAmount = Earning::whereDate('created_at', $today)
        ->where('status', 'Pending')
        ->pluck('amount')
        ->sum();

        // new company
        $totalNewCompany = Company::whereDate('created_at', $today)
        ->count();

        // total expired amount
        $totalFrozenAmount = Earning::where('status','expired')
        ->pluck('amount')
        ->sum();

        // total frozen account
        $filteredCompanies = Company::with('user')->get();
        $totalFrozenAccount = $filteredCompanies->filter(function ($company) {
            return $company->user->status != 1;
        })->count();

        // earning graph 
        $totalEarningsGraph = Earning::whereIn('status', ['paid', 'expired'])
        ->pluck('amount');
        $timestamp = strtotime(Carbon::now()->startOfMonth());
        $earningsGraphData = [];
        foreach ($totalEarningsGraph as $earnings) {
        $earningsGraphData[] = [$timestamp * 1000, (float) $earnings];
        $timestamp += 86400; 
        }
        $eraningGraph = json_encode($earningsGraphData);

        // total users
        $totalUsersByMonths = [];
        $totalUsersByMonths = $this->getUserCountPerMonth(); 

        // total products
        $products = Product::all();
        $totalProducts = $products->count();
        $activeProducts = $products->where('status', 1)->count();
        $draftProducts = $products->where('status', 0)->count();

        // company user 
        $users = Company::with('user')->get();
        $companyUusers = $users->pluck('user')->flatten();
        $getActiveInActiveUsers = $this->getActiveInActiveUsers($companyUusers);
 
        // Top Active Company User
        $topActiveCompanyUsers = [];
        $topActiveCompanyUsers = $this->getTopActiveCompanyUsers();

        return view('analytics/index',compact('totalUsersByMonths','totalProducts','activeProducts','draftProducts','topActiveCompanyUsers','getActiveInActiveUsers','totalEarnings','todayEarnings','totalDueAmount','totalNewCompany','totalFrozenAmount','totalCurrentPayment','todayDueAmount','totalFrozenAccount','eraningGraph'));
    }

    // top active user by company
    private function getTopActiveCompanyUsers()
    {
        $toactiveUser = User::with('roles')
        ->whereHas('roles', function ($query) {
            $query->where('slug', 'company');
        })
        ->where('status',1)
        ->get();

        return $toactiveUser;
    }

    // total user year
    // private function getActiveInActiveUsers($data)
    // { 
    //     $activeCountByDate = [];
    //     $inactiveCountByDate = [];

    //     $currentDate = Carbon::now();
    //     $dates = [];
    //     $active_users = [];
    //     $inactive_users = [];

    //     foreach ($data as $record) {
    //         $createdAt = Carbon::parse($record['created_at']);

    //         $endDate = Carbon::parse($record['end_date']);
    //         if ($record->status == 1) {
    //             $status = 'active';
    //         } else {
    //             $status = 'inactive';
    //         }

    //         $createdDate = $createdAt->format('Y-m-d');
    //         $dates[] = $createdDate;
    //         if (!isset($activeCountByDate[$createdDate])) {
    //             $activeCountByDate[$createdDate] = 0;
    //         }

    //         if (!isset($inactiveCountByDate[$createdDate])) {
    //             $inactiveCountByDate[$createdDate] = 0;
    //         }

    //         if ($status === 'active') {
    //             $activeCountByDate[$createdDate]++;
    //         } else {
    //             $inactiveCountByDate[$createdDate]++;
    //         }
    //         $active_users[] = $activeCountByDate[$createdDate];
    //         $inactive_users[] = $inactiveCountByDate[$createdDate];
    //     }
    //     return ['dates' => $dates, 'active_users' => $active_users, 'inactive_users' => $inactive_users];
    // }

    // user by months 
    private function getActiveInActiveUsers($data)
    {
        $activeCountByDate = [];
        $inactiveCountByDate = [];

        $currentMonth = Carbon::now()->format('m');
        $dates = [];
        $active_users = [];
        $inactive_users = [];

        foreach ($data as $record) {
            $createdAt = Carbon::parse($record['created_at']);

            // Check if the record's creation month is the current month
            if ($createdAt->format('m') !== $currentMonth) {
                continue; // Skip if it's not the current month
            }

            $status = $record->status == 1 ? 'active' : 'inactive';

            $createdDate = $createdAt->format('Y-m-d');
            $dates[] = $createdDate;

            if (!isset($activeCountByDate[$createdDate])) {
                $activeCountByDate[$createdDate] = 0;
            }

            if (!isset($inactiveCountByDate[$createdDate])) {
                $inactiveCountByDate[$createdDate] = 0;
            }

            if ($status === 'active') {
                $activeCountByDate[$createdDate]++;
            } else {
                $inactiveCountByDate[$createdDate]++;
            }

            $active_users[] = $activeCountByDate[$createdDate];
            $inactive_users[] = $inactiveCountByDate[$createdDate];
        }

        return ['dates' => $dates, 'active_users' => $active_users, 'inactive_users' => $inactive_users];
    }


    // total user by months
    private function getUserCountPerMonth()
    {
        $userCounts = [];
        $currentYear = Carbon::now()->year;

        for ($month = 1; $month <= 12; $month++) {
            $userCount = User::whereMonth('created_at', $month)
                ->whereYear('created_at', $currentYear)
                ->count();

            $userCounts[] = $userCount;
        }

        return $userCounts;
    }

}

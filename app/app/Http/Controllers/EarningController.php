<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Earning;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt; 
use Barryvdh\DomPDF\Facade\Pdf;

class EarningController extends Controller
{
    public function index()
    {

        $status = isset($_GET['status']) ? $_GET['status'] : '';
        $search = isset($_GET['search']) ? $_GET['search'] : '';

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

        $earnings = Earning::with('user')->whereIn('status',['paid','expired','pending']);

        if (!empty($status)) {
            if ($status == 'asc') {
                $earnings->orderBy('id', 'asc');
            }

            if ($status == 'desc') {
                $earnings->orderBy('id', 'desc');
            }
        }else{
            $earnings->orderBy('id', 'desc');
        }

        // Common search query
        $searchText = '';
        if (!empty($search)) {
            $searchText = $search;
            $earnings->where('package_name', 'like', '%' . $search . '%');
        }

        $earnings = $earnings->paginate(12);

        return view('earnings/index',compact('earnings','totalEarnings','todayEarnings','totalCurrentPayment','searchText'));
    }

    public function show($id)
    { 
        $earning = Earning::find($id);
        return view('earnings/show',compact('earning'));
    }

    // generate pdf
    public function generatePdf($payment_id){
          
        if (!$payment_id) {
            return redirect()->back()->with('error','No payment information found!');
        }

        $payment_id = Crypt::decrypt($payment_id);
        $payment = Earning::where('payment_id',$payment_id)->with('user')->first();

        $pdf = Pdf::loadView('payments.invoice.package',['payment' => $payment]);
        return $pdf->download('invoice-'.$payment_id.'.pdf');
    }
}
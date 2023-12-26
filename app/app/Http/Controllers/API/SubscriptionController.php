<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\PricingPackage;
use App\Models\Earning;
use App\Models\Company;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Illuminate\Support\Carbon;
use Stripe\Stripe; 
use Stripe\Price;
use Stripe\Product; 

class SubscriptionController extends ApiController
{

    public function index()
    { 
        $packages = PricingPackage::all();
        if ($packages) {
            return $this->jsonResponse(false,$this->success, $packages, $this->emptyArray,JsonResponse::HTTP_OK);
        }else{
            return $this->jsonResponse(true,$this->failed,$this->emptyArray, ['Packages not found'], JsonResponse::HTTP_NOT_FOUND);
        }
    }

    public function handleIinitialization(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $package = PricingPackage::find($request->package_id);
            $company = Company::find($request->user_id);
            $price = ($request->package_type == 'Yearly') ? $package->yearly_price : $package->price;

            if ($request->package_id == ($package->price || $package->yearly_price)) {

                $earning = new Earning();
                $earning->pricing_packages_id = $package->id;
                $earning->company_id = $company->id;
                $earning->user_id = $request->user_id;
                $earning->package_name = $package->name;
                $earning->payment_id = '';
                $earning->amount = $price;
                $earning->package_type = $request->package_type;
                $earning->status = "Pending";
                $earning->start_at = NULL;
                $earning->end_at = NULL;
                $earning->save();
            }

            // Create a Product in Stripe
            $product = Product::create([
                'name' => $package->name, 
                'description' => $request->package_type == 'Yearly' ? 'Package Type: Yearly' : 'Package Type: Monthly',
                'images' => [asset('assets/images/logo.svg')],
            ]);

            // Create a Price in Stripe
            $stripePrice = Price::create([
                'product' => $product->id,
                'unit_amount' => $price * 100,
                'currency' => 'eur',
            ]);

            // Create a Checkout Session
            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [
                    [
                        'price' => $stripePrice->id,
                        'quantity' => 1,
                    ],
                ],
                'mode' => 'payment',
                'success_url' => url('payment/success') . '?session_id={CHECKOUT_SESSION_ID}&package_id=' . $package->id . '&earning_id=' . $earning->id,
                'cancel_url' => url('payment/cancel'),
            ]);

            return $this->jsonResponse(false,$this->success, $session->url, $this->emptyArray,JsonResponse::HTTP_OK);

        } catch (\Exception $e) {
            return $this->jsonResponse(true, $this->failed, $request->all(), [$e->getMessage()], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function handleSuccess(Request $request)
    {

        try {
            
            Stripe::setApiKey(env('STRIPE_SECRET'));
            $sessionId = $request->input('session_id'); 
            $packageId = $request->input('package_id'); 
            $earningId = $request->input('earning_id'); 

            $session = Session::retrieve($sessionId);
            $package = PricingPackage::find($packageId);
            $paymentId = $session->payment_intent;
            $paymentStatus = $session->payment_status; 
            $amountPaid = $session->amount_total / 100;    
            
            $earning = Earning::find($earningId);   
            $earning->payment_id = $paymentId;
            $earning->amount = $amountPaid; 
            $earning->status = $paymentStatus;
            $earning->start_at = Carbon::now();
            $earning->end_at = Carbon::now()->addDays(30);
            $earning->save();

            $data = [
                'package' => $package,
                'payment_info' => [
                    'payment_status' => $paymentStatus,
                    'payment_id' => $paymentId,
                    'amount' => $amountPaid,
                ],
                // 'earnings' => $earning
            ];

            return $this->jsonResponse(false, $this->success, $data, $this->emptyArray, JsonResponse::HTTP_OK);

        } catch (\Exception $e) {
            return $this->jsonResponse(true, $this->failed, $request->all(), [$e->getMessage()], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function handleCancel(Request $request)
    {
        return response()->json(['data' => 'FAILED']);
    }
    
}
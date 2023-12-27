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
        
        foreach ($packages as $package) { 
            $package->features = json_decode($package->features, true);
            $features = [];
            foreach ($package->features as $feature) {
                 $features[] = $feature;
            }
            $package->features = $features;
        }
        if ($packages) {
            return $this->jsonResponse(false,$this->success, $packages, $this->emptyArray,JsonResponse::HTTP_OK);
        }else{
            return $this->jsonResponse(true,$this->failed,$this->emptyArray, ['Packages not found'], JsonResponse::HTTP_NOT_FOUND);
        }
    }

    public function handlePaymentRequest(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $package = PricingPackage::find($request->package_id);
            $company = Company::find($request->user_id);
            $price = ($request->package_type == 'Yearly') ? $package->yearly_price : $package->price;

            $checkout = Earning::where('user_id', $request->user_id)->where('pricing_packages_id',$request->package_id)->where('status','paid')->first();
            if($checkout){
                return $this->jsonResponse(true,$this->failed,$this->emptyArray, ['You have already purchased this Package!'], JsonResponse::HTTP_NOT_FOUND);
            }

            $checkout2 = Earning::where('user_id', $request->user_id)->where('status','paid')->first();

            if($checkout2){
                 $checkout2->status = 'expired';
                 $checkout2->save();
            }

            if ($price == ($package->price || $package->yearly_price)) {

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
                'success_url' => url('purchase/success') . '?session_id={CHECKOUT_SESSION_ID}&package_id=' . $package->id . '&purchase_id=' . $earning->id,
                'cancel_url' => url('purchase/cancel'),
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
            $earningId = $request->input('purchase_id'); 

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
            $earning->end_at =  $earning->package_type == 'Monthly' ? Carbon::now()->addDays(30) : Carbon::now()->addDays(365);
            $earning->save();

            $data = [
                'purchased_info' => $earning,
                'current_package' => $package,
            ];

            return $this->jsonResponse(false, $this->success, $data, $this->emptyArray, JsonResponse::HTTP_OK);

        } catch (\Exception $e) {
            return $this->jsonResponse(true, $this->failed, $request->all(), [$e->getMessage()], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function handleCancel(Request $request)
    {
        $earningId = $request->input('purchase_id');
        $earning = Earning::find($earningId);   
        $earning->payment_id = 'N/A';
        $earning->amount = '00.00'; 
        $earning->status = 'Cancled';
        $earning->start_at = NULL;
        $earning->end_at = NULL;
        $earning->save(); 

        return $this->jsonResponse(true, $this->failed, $request->all(), [$e->getMessage()], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
    }
    
}
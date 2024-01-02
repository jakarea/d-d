<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\PricingPackage;
use App\Models\User;
use App\Models\Earning;
use App\Models\Company;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use Stripe\Stripe; 
use stdClass;
use Stripe\Price;
use Stripe\Product; 

class SubscriptionController extends ApiController
{

    public function index()
    { 
        $packages = PricingPackage::with('myPurchaseInfo')->get(); 
        
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
            
            if (!$package) {
                return $this->jsonResponse(true,$this->failed,$this->emptyArray, ['No Package Found!'], JsonResponse::HTTP_NOT_FOUND);
            }

            $companyUser = User::find($request->user_id); 

            if (!$companyUser || ($companyUser->id != auth()->user()->id)) {
                return $this->jsonResponse(true,$this->failed,$this->emptyArray, ['No User Found!'], JsonResponse::HTTP_NOT_FOUND);
            }

            $company = Company::where('user_id',$request->user_id)->first();

            if (!$company || $company == NULL) {
                return $this->jsonResponse(true,$this->failed,$this->emptyArray, ['You do not have coumpany to subscribe!'], JsonResponse::HTTP_NOT_FOUND);
            } 
            
            $price = $package->price;

            if ($request->package_type == 'Yearly') {
                if ($request->price != $package->yearly_price) {
                    return $this->jsonResponse(true,$this->failed,$this->emptyArray, ['Yearly price did not matched!'], JsonResponse::HTTP_NOT_FOUND);
                }
                $price = $package->yearly_price;
            }else{
                if ($request->price != $package->price) {
                    return $this->jsonResponse(true,$this->failed,$this->emptyArray, ['Monthly price did not matched!'], JsonResponse::HTTP_NOT_FOUND);
                }
                $price = $package->price;
            }

            $checkout = Earning::where('user_id', $request->user_id)->where('pricing_packages_id',$package->id)->where('status','paid')->first();

            if($checkout){
                return $this->jsonResponse(true,$this->failed,$this->emptyArray, ['You have already purchased this package!'], JsonResponse::HTTP_NOT_FOUND);
            }

            $checkout2 = Earning::where('user_id', $request->user_id)->where('status','paid')->first();

            if($checkout2){
                 $checkout2->status = 'expired';
                 $checkout2->save();
            }

            if ($price) {
                $earning = Earning::updateOrCreate(
                    [
                        'pricing_packages_id' => $package->id,
                        'company_id' => $company->id,
                        'user_id' => $request->user_id,
                    ],
                    [
                        'package_name' => $package->name,
                        'payment_id' => '',
                        'amount' => $price,
                        'package_type' => $request->package_type,
                        'status' => 'Pending', 
                        'start_at' => null,
                        'end_at' => null,
                    ]
                );
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
                'success_url' => url('api/purchase/success') . '?session_id={CHECKOUT_SESSION_ID}&package_id=' . $package->id . '&purchase_id=' . $earning->id,
                'cancel_url' => url('api/purchase/cancel'),
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
            if (!$earning) {
                return view('payments/package/cancel');
            }
            $earning->payment_id = $paymentId;
            $earning->amount = $amountPaid; 
            $earning->status = $paymentStatus;
            $earning->start_at = Carbon::now();
            $earning->end_at =  $earning->package_type == 'Monthly' ? Carbon::now()->addDays(30) : Carbon::now()->addDays(365);
            $earning->save();

            // $user = User::where('id',$earning->user_id)->first();

            // $data = new stdClass(); 
            // $data->purchased_info = $earning;
            // $data->current_package = $package;
            // $data->user = $user;

        //     return $data;
        //     // Generate and save the PDF file
        //    return $pdf = PDF::loadView('payments.package.invoice', ['purchase' => $data]);
        //     $pdfContent = $pdf->output();

        //     // Send the email with the PDF attachment
        //     $mailInfo = Mail::send('payments.package.invoice', ['purchase' => $data], function($message) use ($pdfContent, $data) {
        //         $message->to(auth()->user()->email)
        //                 ->subject('Invoice')
        //                 ->attachData($pdfContent,  "Test".'.pdf', ['mime' => 'application/pdf']);
        //     });

            // return view('payments/package/success',compact('data'))->with('success','Package Purchase Successfuly Completed!');
            return view('payments/package/success');


        } catch (\Exception $e) {
            // return $this->jsonResponse(true, $this->failed, $request->all(), [$e->getMessage()], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
            return view('payments/package/cancel');
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

        return view('payments/package/cancel');

        // return $this->jsonResponse(true, $this->failed, $request->all(), [$e->getMessage()], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
    }
    
}
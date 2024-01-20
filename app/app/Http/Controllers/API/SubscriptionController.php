<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\PricingPackage;
use App\Models\User;
use App\Models\Earning;
use App\Models\Company;
use App\Models\Notification;
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
        $packages = PricingPackage::with('myPurchaseInfo')
        ->where('status','active')
        ->get();

        foreach ($packages as $package) {
            $package->features = json_decode($package->features, true);
            $features = [];
            foreach ($package->features as $feature) {
                $features[] = $feature;
            }
            $package->features = $features;
        }
        if ($packages) {
            return $this->jsonResponse(false, $this->success, $packages, $this->emptyArray, JsonResponse::HTTP_OK);
        } else {
            return $this->jsonResponse(true, $this->failed, $this->emptyArray, ['Packages not found'], JsonResponse::HTTP_NOT_FOUND);
        }
    }

    public function handlePaymentRequest(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));


        try {
            $package = PricingPackage::find($request->package_id);

            if (!$package) {
                return $this->jsonResponse(true, $this->failed, $this->emptyArray, ['No Package Found!'], JsonResponse::HTTP_NOT_FOUND);
            }

            $companyUser = User::find($request->user_id);

            if (!$companyUser || ($companyUser->id != auth()->user()->id)) {
                return $this->jsonResponse(true, $this->failed, $this->emptyArray, ['No User Found!'], JsonResponse::HTTP_NOT_FOUND);
            }

            $company = Company::where('user_id', $request->user_id)->first();

            if (!$company || $company == NULL) {
                return $this->jsonResponse(true, $this->failed, $this->emptyArray, ['You do not have coumpany to subscribe!'], JsonResponse::HTTP_NOT_FOUND);
            }

            $price = $package->price;

            if ($request->package_type == 'Yearly') {
                if ($request->price != $package->yearly_price) {
                    return $this->jsonResponse(true, $this->failed, $this->emptyArray, ['Yearly price did not matched!'], JsonResponse::HTTP_NOT_FOUND);
                }
                $price = $package->yearly_price;
            } else {
                if ($request->price != $package->price) {
                    return $this->jsonResponse(true, $this->failed, $this->emptyArray, ['Monthly price did not matched!'], JsonResponse::HTTP_NOT_FOUND);
                }
                $price = $package->price;
            }

            $checkout = Earning::where('user_id', $request->user_id)
            ->where('pricing_packages_id', $package->id)
            ->where('end_at','>', now())
            ->where('status', 'paid')
            ->first();

            if ($checkout) {
                return $this->jsonResponse(true, $this->failed, $this->emptyArray, ['You have already purchased this package!'], JsonResponse::HTTP_NOT_FOUND);
            }

            if ($price) { 

                $earning = Earning::where('company_id', $company->id)
                ->where('user_id', $request->user_id)
                ->whereIn('status', ['pending', 'trail'])->first();

                if ($earning) {
                    $earning->package_name = $package->name;
                    $earning->pricing_packages_id = $package->id;
                    $earning->amount = $price;
                    $earning->package_type = $request->package_type;
                    $earning->status = 'pending';
                    $earning->save();
                }else{
                   $earning = Earning::create( 
                    [
                        'company_id' => $company->id,
                        'user_id' => $request->user_id,
                        'package_name' => $package->name,
                        'pricing_packages_id' => $package->id,
                        'payment_id' => '',
                        'amount' => $price,
                        'package_type' => $request->package_type,
                        'status' => 'pending',
                        'start_at' => null,
                        'end_at' => null,
                    ]
                ); 
                }

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

            return $this->jsonResponse(false, $this->success, $session->url, $this->emptyArray, JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return $this->jsonResponse(true, $this->failed, $request->all(), [$e->getMessage()], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function handleSuccess(Request $request)
    {

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

        // set expired previous package
        $oldPack = Earning::where('user_id', $earning->user_id)
        ->where('status', 'paid')
        ->first();

        if ($oldPack) {
            $oldPack->status = 'expired';
            $oldPack->save();
        }

        $earning->payment_id = $paymentId;
        $earning->amount = $amountPaid;
        $earning->status = $paymentStatus;
        $earning->start_at = Carbon::now();
        $earning->end_at =  $earning->package_type == 'Monthly' ? Carbon::now()->addDays(30) : Carbon::now()->addDays(365);
        $earning->save();
        

        // notification create for new product create  
        Notification::create([
            'creator_id' => $earning->user_id,
            'receiver_id' => $earning->company_id,
            'action_id' => $earning->id,
            'type' => 'purchase',
            'action_link' => "Earning",
            'message' => "New Subscription",
            'status' => 1,
            'role' => 'admin'
        ]);

        $user = User::find($earning->user_id);

        // Generate and save the PDF file
        $pdf = PDF::loadView('payments.invoice.package', ['earning' => $earning, 'user' => $user]);
        $pdfContent = $pdf->output();

        // Send the email with the PDF attachment
        $mailInfo = Mail::send('payments.invoice.package', ['earning' => $earning, 'user' => $user], function ($message) use ($pdfContent, $earning, $user) {
        $message->to($user->email)
                ->subject('Invoice')
                ->attachData($pdfContent,  $earning->package_name . '.pdf', ['mime' => 'application/pdf']);
        });

        return view('payments/package/success', compact('pdfContent'));
    }

    public function handleCancel(Request $request)
    {
        $earningId = $request->input('purchase_id');
        $earning = Earning::find($earningId);
        $earning->payment_id = 'N/A';
        $earning->amount = '00.00';
        $earning->status = 'failed';
        $earning->start_at = NULL;
        $earning->end_at = NULL;
        $earning->save();

        return view('payments/package/cancel');
    }

    public function expired()
    {
        $earning = Earning::where('user_id', auth()->user()->id)
            ->where('company_id', auth()->user()->company->id)
            ->first();

        if ($earning) {

            if($earning->status == 'trail'){
                return $this->jsonResponse(true, 'Your trial period has expired, choose a plan to continue.', ['trail_end_date' => $earning->end_at], $this->emptyArray, JsonResponse::HTTP_OK);
            }else{
                return $this->jsonResponse(true, 'Your subscription period has expired, choose a plan to continue again!', ['subscription_end_date' => $earning->end_at], $this->emptyArray, JsonResponse::HTTP_OK);
            }
            
        } else {
            return $this->jsonResponse(true, 'Your subscription period has expired, choose a plan to continue.', 'No Package Found!', $this->emptyArray, JsonResponse::HTTP_OK);
        }
    }
}

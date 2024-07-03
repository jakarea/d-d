<?php

namespace App\Http\Controllers\API;

use stdClass;
use Stripe\Price;
use Stripe\Stripe;
use Stripe\Product;
use Stripe\Webhook;
use App\Models\User;
use App\Models\Company;
use App\Models\Earning;
use Stripe\Subscription;
use App\Models\Notification;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use App\Models\PricingPackage;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Mail\VerificationMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SubscriptionController extends ApiController
{

    public function index()
    {
        $packages = PricingPackage::with('myPurchaseInfo')
            ->where('status', 'active')
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
                ->where('end_at', '>', now())
                ->where('status', 'paid')
                ->where('package_type', $request->package_type)
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
                } else {
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

            // return response()->json($earning);

            // Create a Product in Stripe
            $product = Product::create([
                'name' => $package->name,
                'description' => $request->package_type == 'Yearly' ? 'Package Type: Yearly' : 'Package Type: Monthly',
                'images' => [asset('assets/images/logo.svg')],
            ]);

            // Create a Price in Stripe (Recurring with Trial)
            $stripePrice = \Stripe\Price::create([
                'product' => $product->id,
                'unit_amount' => $price * 100, // The amount should be in the smallest currency unit (e.g., cents)
                'currency' => 'eur',
                'recurring' => [
                    'interval' => 'month', // You can set 'day', 'week', 'month', or 'year'
                    'interval_count' => 1, // Number of intervals between each subscription billing
                ],
            ]);

            $priceId = $stripePrice->id;

            // Create a Checkout Session
            $session = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card', 'ideal'],
                'line_items' => [
                    [
                        'price' => $priceId,
                        'quantity' => 1,
                    ],
                ],
                'mode' => 'subscription',
                'subscription_data' => [
                    'trial_period_days' => 6,
                ],
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

        $subscription = Subscription::retrieve($session->subscription);
        // return response()->json($subscription);

        $timePeriodAtTimestamp = isset($subscription->billing_cycle_anchor) ? $subscription->billing_cycle_anchor : null;
        $timePeriodAt = $timePeriodAtTimestamp ? date('Y-m-d', $timePeriodAtTimestamp) : null;
        // return response()->json($trialEndsAt);

        $package = PricingPackage::find($packageId);
        $paymentId = $session->invoice;
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
            $oldPack->status = 'cancled';
            $oldPack->save();
        }

        $earning->subscription_id = $subscription->id ?? null;
        $earning->payment_id = $paymentId;
        $earning->amount = $amountPaid;
        $earning->status = $paymentStatus;
        $earning->start_at = Carbon::now();
        $earning->end_at = $timePeriodAt;
        $earning->save();


        // $earning->package_type == 'Monthly' ? Carbon::now()->addDays(30) : Carbon::now()->addDays(365);


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
        // $mailInfo = Mail::send('payments.invoice.package', ['earning' => $earning, 'user' => $user], function ($message) use ($pdfContent, $earning, $user) {
        // $message->to($user->email)
        //         ->subject('Invoice')
        //         ->attachData($pdfContent,  $earning->package_name . '.pdf', ['mime' => 'application/pdf']);
        // });

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

            if ($earning->status == 'trail') {
                return $this->jsonResponse(true, 'Your trial period has expired, choose a plan to continue.', ['trail_end_date' => $earning->end_at], ['Your trail has expired'], JsonResponse::HTTP_OK);
            } else {
                return $this->jsonResponse(true, 'Your subscription period has expired, choose a plan to continue again!', ['subscription_end_date' => $earning->end_at], ['Your subscription has expired'], JsonResponse::HTTP_OK);
            }
        } else {
            return $this->jsonResponse(true, 'Your subscription period has expired, choose a plan to continue.', 'No Package Found!', ['Your subscription has expired'], JsonResponse::HTTP_OK);
        }
    }

    public function cancel()
    {
        $earning = Earning::where('user_id', auth()->user()->id)
            ->where('company_id', auth()->user()->company->id)
            ->where('status', 'paid')
            ->first();

        if ($earning) {
            $earning->status = 'cancled';
            $earning->save();

            return $this->jsonResponse(false, 'Cancled Success!', $earning, $this->emptyArray, JsonResponse::HTTP_OK);
        } else {
            return $this->jsonResponse(true, 'No Subscription Package found!.', 'No Package Found!', $this->emptyArray, JsonResponse::HTTP_OK);
        }
    }


    public function handleWebhook(Request $request)
    {
        $payload = $request->getContent();
        $sig_header = $request->header('Stripe-Signature');

        $event = Webhook::constructEvent(
            $payload,
            $sig_header,
            env('STRIPE_WEBHOOK_SECRET')
        );



        switch ($event->type) {
            case 'customer.subscription.updated':

                $subscriptionData = $event->data->object;
                $timePeriodAtTimestamp = isset($subscriptionData->current_period_end) ? $subscriptionData->current_period_end : null;
                $timePeriodAt = $timePeriodAtTimestamp ? date('Y-m-d', $timePeriodAtTimestamp) : null;

                Log::info('SubscriptionID: ', ['subs_id' => $subscriptionData->id]);

                $subscription = Earning::where('subscription_id', $subscriptionData->id)->first();

                Log::info('Previous: ', ['subscription' => $subscription]);

                $subscription->update([
                    'status' => 'expired',
                ]);

                Log::info('Updated: ', ['subscription' => $subscription]);

                // new data insert
                $clonedEarningData = $subscription->replicate();
                $clonedEarningData->status = 'paid';
                $clonedEarningData->end_at = $timePeriodAt;
                $clonedEarningData->save();

                Log::info('New: ', ['newsubscription' => $clonedEarningData]);
                break;

            default:

                break;
        }
        return response()->json(['success' => true]);
    }

    public function check($user_id)
    {

        $mainUser = auth()->user();
        $user = User::findOrFail($user_id);

        $companyId = 0;
        if ($user->company) {
            $companyId = $user->company->id;
        } else {
            return $this->jsonResponse(true, 'User do not have required role!', $user, $this->emptyArray, JsonResponse::HTTP_NOT_FOUND);
        }

        if ($user->id == $mainUser->id) {

            $subscription = Earning::where('user_id', $user->id)
                ->whereIn('status', ['paid', 'trail'])
                ->where('company_id', $companyId)
                ->first();

            if (!$subscription) {
                return $this->jsonResponse(true, 'No Subscription plan found!', $user, $this->emptyArray, JsonResponse::HTTP_OK);
            }

            // expired info
            $expiredInfo = [
                'status' => 'expired',
                'subscription_end_date' => $subscription->end_at
            ];

            // active info
            $activeInfo = [
                'status' => 'active',
                'subscription_end_date' => $subscription->end_at
            ];

            if ($subscription && $subscription->end_at && $subscription->end_at < now() || $subscription->end_at == null) {
                return $this->jsonResponse(true, 'Your Subscription plan has expired', $expiredInfo, $this->emptyArray, JsonResponse::HTTP_OK);
            } else {
                return $this->jsonResponse(false, 'Your Subscription plan is active', $activeInfo, $this->emptyArray, JsonResponse::HTTP_OK);
            }
        } else {
            return $this->jsonResponse(true, 'User info not matched!', $user_id, $this->emptyArray, JsonResponse::HTTP_NOT_FOUND);
        }
    }

    // verify account from website for company
    public function verifyAcccountView($user_id,$verify_code)
    {
        $user = User::find($user_id);

        if ($user) {
           
            if ($user->verification_code == $verify_code) {
                return view('company.verify.index');
            }else{
                return redirect('/')->with('error', 'Wrong verify code!');
            }
            
        }else{
            return redirect('/')->with('error', 'No user found!');
        }
        
    }

    public function verifyAcccount(Request $request)
    { 

        $credentials = $request->validate([
            'verify_code' => 'required|string',
        ]);

       $user = User::where('id', Auth::id())->first();

        if ($user->verification_code === $credentials['verify_code'] && !$user->email_verified_at) {
            // Verification successful
            $user->update([
                'email_verified_at' => now(),
                'verification_code' => null,
                'status' => 1,
            ]);

            // send mail afetr verify
            Mail::send('emails.verify-success', ['user' => $user], function ($message) use ($user) {
                $message->to($user->email)
                    ->subject('Verification Success!')
                    ->text('Your account has been successfully verified. Thank you for choosing us! DnD');
            });                

            return redirect('/pricing')->with('success', 'Verification Success!');

        }else{
            return redirect()->back()->with('error','Verification Failed!');
        }
    }
}
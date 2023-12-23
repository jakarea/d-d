<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\PricingPackage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Stripe\Stripe;

class SubscriptionController extends ApiController
{

    public function index()
    { 

        Stripe::setApiKey(env('STRIPE_SECRET')); 

        $packages = PricingPackage::get();
        $responseData = [
            'error' => false,
            'message' => $this->success,
            'data' => $packages->toArray(),
            // 'stripe_secret_key' => env('STRIPE_SECRET'),
            'errors' => $this->emptyArray,
        ];
 
        return response()->json($responseData, JsonResponse::HTTP_OK);
    }
}
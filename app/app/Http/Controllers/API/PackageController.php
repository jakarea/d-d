<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\PricingPackage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PackageController extends ApiController
{
    public function index()
    {
        $packages = PricingPackage::get();

        return $this->jsonResponse(false, $this->success, $packages, $this->emptyArray, JsonResponse::HTTP_OK);
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddReviewRequest;
use App\Models\Review;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReviewController extends ApiController
{
    public function placeReview(AddReviewRequest $request):JsonResponse
    {
        try {
            $request['user_id'] = auth()->user()->id;

            $review =  Review::create($request->except('_method', '_token'));

            return $this->jsonResponse(false, "Review submitted successfully", $review, $this->emptyArray, JsonResponse::HTTP_CREATED);

        }catch (\Exception $e){
            return $this->jsonResponse(true,$this->failed, $request->all(),[$e->getMessage(),JsonResponse::HTTP_INTERNAL_SERVER_ERROR]);
        }
    }
}

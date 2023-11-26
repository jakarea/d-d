<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddReviewRequest;
use App\Models\Like;
use App\Models\Review;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReviewController extends ApiController
{
    public function reviewOfProduct(AddReviewRequest $request): JsonResponse
    {
        try {
            $request['user_id'] = auth()->user()->id;

            $review = Review::create($request->except('_method', '_token'));

            return $this->jsonResponse(false, "Review submitted successfully", $review, $this->emptyArray, JsonResponse::HTTP_CREATED);

        } catch (\Exception $e) {
            return $this->jsonResponse(true, $this->failed, $request->all(), [$e->getMessage(), JsonResponse::HTTP_INTERNAL_SERVER_ERROR]);
        }
    }

    public function likeOfReview(Request $request)
    {

        try {

            $like = Like::where('user_id', auth()->user()->id)->where('review_id', $request->review_id)->first();

            if(!empty($like)){
                $like->delete();
            }else{
                $request['user_id'] = auth()->user()->id;
                $like = Like::create($request->except('_method', '_token'));
            }

            return $this->jsonResponse(false, $this->success, $like, $this->emptyArray, JsonResponse::HTTP_OK);

        } catch (\Exception $e) {

            return $this->jsonResponse(true, $this->failed, $request->all(), [$e->getMessage(), JsonResponse::HTTP_INTERNAL_SERVER_ERROR]);
        }
    }


}

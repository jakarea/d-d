<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddReviewRequest;
use App\Http\Requests\User\LikeRequest;
use App\Http\Requests\User\ReplyRequest;
use App\Http\Requests\User\ReviewAcceptRequest;
use App\Models\Dislike;
use App\Models\Like;
use App\Models\Reply;
use App\Models\Review;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Auth;


class ReviewController extends ApiController
{

    public function reviewsOfCompany($companyId)
    {
        $reviews = Review::with(['likes','dislikes','replies'])
            ->where('company_id', $companyId)
            ->where('status', false)
            ->get();

        if(!empty($reviews)){
            return $this->jsonResponse(false,$this->success, $reviews, $this->emptyArray,JsonResponse::HTTP_OK);
        }else{
            return $this->jsonResponse(true,$this->failed,$this->emptyArray, ['Review not found'], JsonResponse::HTTP_NOT_FOUND);
        }
    }

    public function reviewAcceptReject(ReviewAcceptRequest $request)
    {

        $review = Review::where('id', $request->review_id)
                         ->where('company_id', $request->company_id)
                         ->first();

        if(!empty($review)){
            if(isset($request->status) && $request->status == true){
                $review->status = true;
                $review->save();
                $message = "Review accepted";
            }elseif (isset($request->status) && $request->status == false){
                $review->delete();
                $message = "Review rejected";
            }
            return $this->jsonResponse(false, $message, $review, $this->emptyArray, JsonResponse::HTTP_OK);
        }else{
            return $this->jsonResponse(true, $this->failed, $request->all(), ['Review not found'], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function reviewOfProduct(AddReviewRequest $request): JsonResponse
    {
        try {
            $request['user_id'] = auth()->user()->id;

            $review = Review::updateOrCreate($request->except('_method', '_token'));

            return $this->jsonResponse(false, "Review submitted successfully", $review, $this->emptyArray, JsonResponse::HTTP_CREATED);

        } catch (\Exception $e) {
            return $this->jsonResponse(true, $this->failed, $request->all(), [$e->getMessage()], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function likeOfReview(LikeRequest $request):JsonResponse
    {

        try {

            $like = Like::where('user_id', auth()->user()->id)->where('review_id', $request->review_id)->first();

            if(!empty($like) && $like->like == true){
                $like->delete();
            }elseif(!empty($like) && $like->like == false){
                $like->like = true;
                $like->save();
            }else{
                $request['user_id'] = auth()->user()->id;
                $like = Like::create($request->except('_method', '_token'));
            }

            return $this->jsonResponse(false, $this->success, $like, $this->emptyArray, JsonResponse::HTTP_OK);

        } catch (\Exception $e) {

            return $this->jsonResponse(true, $this->failed, $request->all(), [$e->getMessage(), JsonResponse::HTTP_INTERNAL_SERVER_ERROR]);
        }
    }


    public function dislikeOfReview(LikeRequest $request):JsonResponse
    {

        $dislike = Like::where('user_id', auth()->user()->id)->where('review_id', $request->review_id)->first();

        try {

            $dislike = Like::where('user_id', auth()->user()->id)->where('review_id', $request->review_id)->first();

            if(!empty($dislike) && $dislike->like == false){
                $dislike->delete();
            }elseif(!empty($dislike) && $dislike->like == true){
                $dislike->like = false;
                $dislike->save();
            }else{
                $request['user_id'] = auth()->user()->id;
                $request['like'] = false;
                $dislike = Like::create($request->except('_method', '_token'));
            }

            return $this->jsonResponse(false, $this->success, $dislike, $this->emptyArray, JsonResponse::HTTP_OK);

        } catch (\Exception $e) {

            return $this->jsonResponse(true, $this->failed, $request->all(), [$e->getMessage(), JsonResponse::HTTP_INTERNAL_SERVER_ERROR]);
        }
    }

    public function replyOfReview(ReplyRequest $request):JsonResponse
    {
        try {

            $request['user_id'] = Auth::id();
            $mainReview = Review::find($request['review_id']);

            if ($mainReview) {
                $newReview = Review::create([
                    'company_id'    => $mainReview->company_id,
                    'product_id'    => $mainReview->product_id,
                    'user_id'       => Auth::id(),
                    'replies_to'    => $mainReview->id,
                    'review'        => $request['reply'],
                    'rating'        => NULL,
                    'status'        => 0,
                ]);  
            }

            return $this->jsonResponse(false, $this->success, $newReview, $this->emptyArray, JsonResponse::HTTP_CREATED);

        }catch (\Exception $e){
            return $this->jsonResponse(true, $this->failed, $request->all(), [$e->getMessage(), JsonResponse::HTTP_INTERNAL_SERVER_ERROR]);
        }
    }




}

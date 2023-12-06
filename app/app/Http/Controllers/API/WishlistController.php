<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddToWishlistRequest;
use App\Models\WishList;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WishlistController extends ApiController
{

    public function wishList()
    {
        $wishlist = WishList::with(['product'=>function($query){
            $query->with(['company','productVarients','reviews'=>function($q){
                $q->with(['likes','dislikes']);

            }]);
        }])->where('user_id', auth()->user()->id)
            ->get();

        if(!$wishlist->isEmpty()){

            return $this->jsonResponse(false, $this->success, $wishlist, $this->emptyArray, JsonResponse::HTTP_OK);
        }else{
            return $this->jsonResponse(true, $this->failed, $this->emptyArray, ['Data not found!'], JsonResponse::HTTP_NOT_FOUND);
        }
    }

    public function addtoWishList(AddToWishlistRequest $request)
    {

        try {

            $wishlist = WishList::where('user_id', auth()->user()->id)
                                ->where('product_id', $request->product_id)
                                ->first();

            if(empty($wishlist)){
                $request['user_id'] = auth()->user()->id;
                $wishlist = WishList::create($request->except('_method', '_token'));
                $message = 'Added to wishlist';
                $statusCode = JsonResponse::HTTP_CREATED;
            }else{
                $message = 'Already added to wishlist';
                $statusCode = JsonResponse::HTTP_OK;
            }

            return $this->jsonResponse(false, $message, $wishlist, $this->emptyArray, JsonResponse::HTTP_CREATED, $statusCode);

        }catch (\Exception $e){
            return $this->jsonResponse(true, $this->failed, $this->emptyArray, [$e->getMessage()], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    public function removeFromWishlist($id)
    {
        $wishList = WishList::find($id);

        if (!empty($wishList)) {

            $wishList->delete();

            return $this->jsonResponse(false, 'WishList deleted successfully', $wishList, $this->emptyArray, JsonResponse::HTTP_OK);
        } else {
            return $this->jsonResponse(true, $this->failed, $this->emptyArray, ['WishList not found'], JsonResponse::HTTP_NOT_FOUND);
        }
    }
}

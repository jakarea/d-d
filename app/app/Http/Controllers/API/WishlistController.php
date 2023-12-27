<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddToWishlistRequest;
use App\Models\WishList;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WishlistController extends ApiController
{

    public function wishList()
    {
        $wishlist = WishList::with(['product'=>function($query){
            $query->with(['company','productVariants','reviews'=>function($q){
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

            $infos = Product::where('id',$wishlist->product_id)->with('company','reviews')->first();  

            return $this->jsonResponse(false, $message, $infos, $this->emptyArray, JsonResponse::HTTP_CREATED, $statusCode);

        }catch (\Exception $e){
            return $this->jsonResponse(true, $this->failed, $this->emptyArray, [$e->getMessage()], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    public function removeFromWishlist($id)
    {
        $wishList = WishList::where('product_id',$id)->where('user_id',auth()->user()->id)->first();
        
        if (!empty($wishList)) {
            $infos = Product::where('id',$wishList->product_id)->with('company','reviews')->first(); 
            $wishList->delete();

            return $this->jsonResponse(false, 'WishList deleted successfully', $infos, $this->emptyArray, JsonResponse::HTTP_OK);
        } else {
            return $this->jsonResponse(true, $this->failed, $this->emptyArray, ['WishList not found'], JsonResponse::HTTP_NOT_FOUND);
        }
    }
}

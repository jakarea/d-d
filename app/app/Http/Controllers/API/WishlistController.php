<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\WishList;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WishlistController extends ApiController
{
    public function addtoWishList(Request $request)
    {

        try {

            $request['user_id'] = auth()->user()->id;
            $wishlist = WishList::create($request->except('_method', '_token'));

            return $this->jsonResponse(false, 'Added into wishlist',$wishlist, $this->emptyArray, JsonResponse::HTTP_CREATED);

        }catch (\Exception $e){
            return $this->jsonResponse(true, $this->failed, $this->emptyArray, [$e->getMessage()], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }

    }
}

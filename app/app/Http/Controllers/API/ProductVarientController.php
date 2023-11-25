<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductAddRequest;
use App\Models\ProductVarient;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductVarientController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductAddRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $validatedData['user_id'] = auth()->user()->id;

            $productVarient = ProductVarient::create($validatedData);

            return $this->jsonResponse(false, 'Product-varient created successfully', $productVarient, [], JsonResponse::HTTP_CREATED);

        }catch (\Exception $e){

            return $this->jsonResponse(true, 'Failed to create product-varient', $request->all(), [$e->getMessage()], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $productVarient = ProductVarient::find($id);

        if (!empty($productVarient)) {
            return $this->jsonResponse(false, $this->success, $productVarient, $this->emptyArray, JsonResponse::HTTP_OK);
        } else {
            return $this->jsonResponse(true, $this->failed, $this->emptyArray, ['Product-varient not found'], JsonResponse::HTTP_NOT_FOUND);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getProductVarientofProduct($productId)
    {
        $productVarientofProduct = ProductVarient::where('product_id',$productId)->get();

        if (!empty($productVarientofProduct)) {
            return $this->jsonResponse(false, $this->success, $productVarientofProduct, $this->emptyArray, JsonResponse::HTTP_OK);
        } else {
            return $this->jsonResponse(true, $this->failed, $this->emptyArray, ['Product-varient not found'], JsonResponse::HTTP_NOT_FOUND);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

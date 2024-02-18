<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductAddRequest;
use App\Models\ProductVariant;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductVariantController extends ApiController
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
        $requestData = $request->all();
        // Get the current URL
        $currentUrl = $request->url();
        $dataToSave = [
            'data' => $requestData,
            'url' => $currentUrl,
        ];
        $jsonContent = json_encode($dataToSave, JSON_PRETTY_PRINT);
        $filePath = storage_path('app/requestData.json');
        file_put_contents($filePath, $jsonContent);
        
        try {
            $validatedData = $request->validated();
            $validatedData['user_id'] = auth()->user()->id;

        $jsonContent = json_encode($validatedData, JSON_PRETTY_PRINT);
        $filePath = storage_path('app/requestData2.json');
        file_put_contents($filePath, $jsonContent);
            $ProductVariant = ProductVariant::create($validatedData);

            return $this->jsonResponse(false, 'Product-variant created successfully', $ProductVariant, [], JsonResponse::HTTP_CREATED);

        }catch (\Exception $e){

            return $this->jsonResponse(true, 'Failed to create product-variant', $request->all(), [$e->getMessage()], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
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
        $ProductVariant = ProductVariant::find($id);

        if (!empty($ProductVariant)) {
            return $this->jsonResponse(false, $this->success, $ProductVariant, $this->emptyArray, JsonResponse::HTTP_OK);
        } else {
            return $this->jsonResponse(true, $this->failed, $this->emptyArray, ['Product-variant not found'], JsonResponse::HTTP_NOT_FOUND);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getProductVariantofProduct($productId)
    {
        $ProductVariantofProduct = ProductVariant::where('product_id',$productId)->get();

        if (!empty($ProductVariantofProduct)) {
            return $this->jsonResponse(false, $this->success, $ProductVariantofProduct, $this->emptyArray, JsonResponse::HTTP_OK);
        } else {
            return $this->jsonResponse(true, $this->failed, $this->emptyArray, ['Product-variant not found'], JsonResponse::HTTP_NOT_FOUND);
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

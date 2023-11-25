<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\Product\UpdateRequest;
use App\Models\Product;
use App\Models\ProductVarient;
use App\Process\ProductProcess;
use Illuminate\Http\Request;
use App\Http\Requests\ProductAddRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;

class ProductController extends ApiController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

        //return var_dump(!empty($products));

        return $this->jsonResponse(0, 'Product success', $products, [], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function store(ProductAddRequest $request)
    {
        try {

            $product = ProductProcess::create($request);

            foreach ($request->product_varients as $productVarient) {
                $productVarient['user_id'] = auth()->user()->id;
                $productVarient['company_id'] = $product->company_id;
                $productVarient['product_id'] = $product->id;

                ProductVarient::create($productVarient);
            }

            $product = Product::with(['productVarients'])->where('id', $product->id)->first();

            // Return a JSON response indicating success
            return $this->jsonResponse(false, 'Product created successfully', $product, [], JsonResponse::HTTP_CREATED);
        } catch (\Exception $e) {
            // Handle any exceptions or errors
            return $this->jsonResponse(true, 'Failed to create product', $request->all(), [$e->getMessage()], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);

        if (!empty($product)) {
            return $this->jsonResponse(false, $this->success, $product, $this->emptyArray, JsonResponse::HTTP_OK);
        } else {
            return $this->jsonResponse(true, $this->failed, $this->emptyArray, ['Product not found'], JsonResponse::HTTP_NOT_FOUND);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {

        try {

            $product = ProductProcess::update($request, $id);

            return $this->jsonResponse(false, 'Product updated successfully', $product, $this->emptyArray, JsonResponse::HTTP_OK);

        } catch (\Exception $e) {
            return $this->jsonResponse(true, 'Failed to update product', $request->all(), [$e->getMessage()], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!empty($product)) {

            $product->delete();

            return $this->jsonResponse(false, 'Product deleted successfully', $product, $this->emptyArray, JsonResponse::HTTP_OK);
        } else {
            return $this->jsonResponse(true, $this->failed, $this->emptyArray, ['Product not found'], JsonResponse::HTTP_NOT_FOUND);
        }
    }
}

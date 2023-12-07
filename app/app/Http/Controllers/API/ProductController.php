<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\Product\UpdateRequest;
use App\Models\Company;
use App\Models\Product;
use App\Models\ProductVarient;
use App\Process\ProductProcess;
use App\Process\ProductVarientProcess;
use App\Traits\FileTrait;
use Illuminate\Http\Request;
use App\Http\Requests\ProductAddRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends ApiController
{
    use FileTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $company = $request->company;
        $searchTerm = $request->keyword;
        $searchLocation = $request->location;

        $sortBy = $request->sortby;
        $sortOrder = $request->sortorder;
        $category = $request->category;

        $query = Product::with(['productVarients', 'company', 'reviews' => function ($query) {
            $query->with(['likes', 'dislikes']);

        }]);

        if (!is_null($company)) {
            $query->where('company_id', $company);
        }

        if (!is_null($category)) {

            $query->where(function ($q) use ($category) {
                $q->where('cats', 'LIKE', '%' . $category . '%');
            });
        }

        if (!is_null($searchTerm)) {
            $searchTerm = strip_tags(trim($searchTerm));
            $query->where('title', 'LIKE', "%{$searchTerm}%");
        }


        if (!is_null($searchLocation)) {
            $searchLocation = strip_tags(trim($searchLocation));
            $query->whereHas('company', function ($q) use ($searchLocation) {
                $q->where('location', 'LIKE', "%{$searchLocation}%");
            });
        }

        if (!is_null($sortBy) && !is_null($sortOrder)) {
            $sortBy = strip_tags(trim($sortBy));
            $query->orderBy($sortBy, $sortOrder);
        } else {
            $query->orderByDesc('id');
        }

        // sort order by where discount price is greatter
        if (!is_null($sortBy)) {

            if ($sortBy == 'offer_product') {
                $query->orderByDesc(DB::raw('price - sell_price'));
            }
        }


        $products = $query->get();

        return $this->jsonResponse(false, $this->success, $products, $this->emptyArray, JsonResponse::HTTP_OK);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function store(ProductAddRequest $request)
    {

        return $this->fileUpload($request->input('image'), "product");
        exit();

        try {

            $product = ProductProcess::create($request);

            if (isset($request->product_varients) && count($request->product_varients) > 0) {

                foreach ($request->product_varients as $productVarient) {
                    $productVarient['user_id'] = auth()->user()->id;
                    $productVarient['company_id'] = $product->company_id;
                    $productVarient['product_id'] = $product->id;
                    $productVarient['cats'] = json_encode($productVarient['cats']);

                    ProductVarient::create($productVarient);
                }
            }

            $product = Product::with(['productVarients'])->where('id', $product->id)->first();

            // Return a JSON response indicating success
            return $this->jsonResponse(false, 'Product created successfully', $product, [], JsonResponse::HTTP_CREATED);
        } catch (\Exception $e) {
            // Handle any exceptions or errors
            return $this->jsonResponse(true, 'Failed to create product', $request->all(), [$e->getMessage()], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function editProduct($id)
    {
        $product = Product::with(['productVarients'])->where('id', $id)->first();

        if (!empty($product)) {
            return $this->jsonResponse(false, $this->success, $product, $this->emptyArray, JsonResponse::HTTP_OK);
        } else {
            return $this->jsonResponse(true, $this->failed, $this->emptyArray, ['Product not found'], JsonResponse::HTTP_NOT_FOUND);
        }
    }

    public function updateProduct(UpdateRequest $request, $id)
    {
        try {
            $product = ProductProcess::update($request, $id);

            $arrayofProductVarientId = ProductVarient::where('product_id', $id)->pluck('id')->toArray();

            $deletableProductVarient = $this->updateProductVarient($request, $product, $arrayofProductVarientId);

            ProductVarient::whereIn('id', $deletableProductVarient)->delete();

            if (isset($product->productVarients)) {
                $product->productVarients;
            }
            return $this->jsonResponse(false, "Product updated successfully", $product, $this->emptyArray, JsonResponse::HTTP_OK);

        } catch (\Exception $e) {
            return $this->jsonResponse(true, 'Failed to update product', $request->all(), [$e->getMessage()], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function productDetails(Request $request, $id)
    {

        $query = Product::with(['productVarients', 'company', 'reviews' => function ($query) {
            $query->with(['likes', 'dislikes']);
        }]);

        if (!is_null($request->company)) {
            $query->where('company_id', $request->company);
        }
        $product = $query->find($id);

        if (!empty($product)) {
            return $this->jsonResponse(false, $this->success, $product, $this->emptyArray, JsonResponse::HTTP_OK);
        } else {
            return $this->jsonResponse(true, $this->failed, $this->emptyArray, ['Product not found'], JsonResponse::HTTP_NOT_FOUND);
        }
    }

    public function getProductsOfCompany($companyId): JsonResponse
    {

        $products = Company::with(['products' => function ($query) {
            $query->with(['reviews' => function ($q) {
                $q->with(['likes', 'dislikes']);
            }]);

        }, 'reviews'])->where('id', $companyId)->first();

        if (!empty($products)) {
            return $this->jsonResponse(false, $this->success, $products, $this->emptyArray, JsonResponse::HTTP_OK);
        } else {
            return $this->jsonResponse(true, $this->failed, $this->emptyArray, ['Products not found'], JsonResponse::HTTP_NOT_FOUND);
        }
    }

    public function companyProductDetails($companyId, $productId)
    {
        $product = Product::with(['productVarients'])
            ->where('company_id', $companyId)
            ->where('id', $productId)
            ->first();


        if (!empty($product)) {
            return $this->jsonResponse(false, $this->success, $product, $this->emptyArray, JsonResponse::HTTP_OK);
        } else {
            return $this->jsonResponse(true, $this->failed, $this->emptyArray, ['Product not found'], JsonResponse::HTTP_NOT_FOUND);
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

        $product = Product::where('user_id',Auth::id())->where('id',$id)->first();

        if (!empty($product)) {

            $product->delete();

            return $this->jsonResponse(false, 'Product deleted successfully', $product, $this->emptyArray, JsonResponse::HTTP_OK);
        } else {
            return $this->jsonResponse(true, $this->failed, $this->emptyArray, ['Product not found'], JsonResponse::HTTP_NOT_FOUND);
        }
    }

    protected function updateProductVarient($request, $product, $arrayofProductVarientId)
    {
        if (isset($request->product_varients)) {
            foreach ($request->product_varients as $productVarient) {
                if (isset($productVarient['id']) && in_array($productVarient['id'], $arrayofProductVarientId)) {

                    $productVarient['user_id'] = auth()->user()->id;
                    $productVarient['company_id'] = $product->company_id;
                    $productVarient['product_id'] = $product->id;
                    $productVarient['cats'] = $productVarient['cats'];

                    ProductVarientProcess::update($productVarient, $productVarient['id']);
                    $key = array_search($productVarient['id'], $arrayofProductVarientId);
                    if ($key !== false) {
                        unset($arrayofProductVarientId[$key]);
                    }
                } else {
                    $productVarient['user_id'] = auth()->user()->id;
                    $productVarient['company_id'] = $product->company_id;
                    $productVarient['product_id'] = $product->id;
                    $productVarient['cats'] = json_encode($productVarient['cats']);

                    ProductVarient::create($productVarient);
                }
            }
        }

        return $arrayofProductVarientId;
    }


}

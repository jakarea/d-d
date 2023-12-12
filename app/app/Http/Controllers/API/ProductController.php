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
use Illuminate\Support\Facades\Storage;

class ProductController extends ApiController
{
    use FileTrait;

    /**
     * Display list of products
     * @param \Illuminate\Http\Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
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
     * Store product with product varients
     * @param \Illuminate\Http\Request $request
     * @return JsonResponse
     */
    public function store(ProductAddRequest $request): JsonResponse
    {

        try {

            $product = ProductProcess::create($request);

            if (isset($request->product_varients) && count($request->product_varients) > 0) {
                foreach ($request->product_varients as $productVarient) {
                    $productVarient['user_id'] = auth()->user()->id;
                    $productVarient['company_id'] = $product->company_id;
                    $productVarient['product_id'] = $product->id;
                    $productVarient['cats'] = json_encode($productVarient['cats']);
                    ProductVarientProcess::create($productVarient);
                }
            }
            $product = Product::with(['productVarients'])->where('id', $product->id)->first();

            return $this->jsonResponse(false, 'Product created successfully', $product, [], JsonResponse::HTTP_CREATED);
        } catch (\Exception $e) {

            return $this->jsonResponse(true, 'Failed to create product', $request->all(), [$e->getMessage()], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Edit specific product
     * @param int $id
     * @return JsonResponse
     */
    public function editProduct($id): JsonResponse
    {
        $product = Product::with(['productVarients'])->where('id', $id)->first();

        if (!empty($product)) {

            return $this->jsonResponse(false, $this->success, $product, $this->emptyArray, JsonResponse::HTTP_OK);
        } else {

            return $this->jsonResponse(true, $this->failed, $this->emptyArray, ['Product not found'], JsonResponse::HTTP_NOT_FOUND);
        }
    }

    /**
     * Update product & product varients
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function updateProduct(UpdateRequest $request, $id): JsonResponse
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
     * Display the specified product
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function productDetails(Request $request, $id): JsonResponse
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

    /**
     * Show products for specific company
     * @param $companyId
     * @return JsonResponse
     */
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

    /**
     * Show company product details
     * @param $companyId
     * @param $productId
     * @return JsonResponse
     */
    public function companyProductDetails($companyId, $productId): JsonResponse
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
     * Delete product with product varients
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id)
    {

        $product = Product::where('user_id', Auth::id())->where('id', $id)->first();

        //delete product images
        if (isset($product->images)) {
            $arrayofImages = json_decode($product->images);
            $this->deleteFile("public", $arrayofImages);
        }

        //delete product varient images
        if(isset($product->productVarients))
        {
            foreach ($product->productVarients as $proVarient)
            {
                $arrayofImages = json_decode($proVarient->images);
                $this->deleteFile("public", $arrayofImages);
            }
        }

        if (!empty($product)) {

            $product->delete();

            return $this->jsonResponse(false, 'Product deleted successfully', $product, $this->emptyArray, JsonResponse::HTTP_OK);
        } else {

            return $this->jsonResponse(true, $this->failed, $this->emptyArray, ['Product not found'], JsonResponse::HTTP_NOT_FOUND);
        }
    }

    /**
     * @param $request
     * @param $product
     * @param $arrayofProductVarientId
     * @return array
     */
    protected function updateProductVarient($request, $product, $arrayofProductVarientId): array
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

                    ProductVarientProcess::create($productVarient);
                }
            }
        }

        return $arrayofProductVarientId;
    }


}

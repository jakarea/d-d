<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Review;
use App\Models\Company;
use App\Models\Product;
use App\Models\Category;
use App\Models\WishList;
use App\Models\AppBanner;
use App\Traits\FileTrait;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\ProductVariant;
use App\Process\ProductProcess;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

use Spatie\Geocoder\Facades\Geocoder;

use App\Process\ProductVariantProcess;
use App\Http\Requests\ProductAddRequest;
use App\Http\Requests\Product\UpdateRequest;

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

        $distance = $request->input('distance') ?? 5;
        $latitude = $request->input('location_latitude');
        $longitude = $request->input('location_longitude');

        // $user_id = $request->user_id ?? auth()->user()->id;
        $user_id = $request->user_id ?? null;
        $company = $request->company;
        $searchTerm = $request->title;
        $searchLocation = $request->location;

        $sortBy = $request->sortby;
        $sortOrder = $request->sortorder;
        $category = $request->category;
        // near my area


        // best deal

        $query = Product::with(['productVariants', 'company', 'wishlist', 'reviews' => function ($query) {
            $query->with(['likes', 'dislikes']);
        }]);

        if ($latitude && $longitude) {
            $query->select('*')
                ->selectRaw('( 6371 * acos( cos( radians(?) ) * cos( radians( location_latitude ) )
                    * cos( radians( location_longitude ) - radians(?) ) + sin( radians(?) )
                    * sin( radians( location_latitude ) ) ) ) AS distance', [$latitude, $longitude, $latitude])
                ->having('distance', '<=', $distance);
        }


        if ($user_id) {
            $company = Company::firstwhere('user_id', $user_id);
        }

        $routeName = Route::currentRouteName();

        if ($routeName === "api.company.product.list") {
            $query->where('company_id', $company->id);
        }

        if (!is_null($category)) {
            $query->where(function ($q) use ($category) {
                $q->where('cats', 'LIKE', '%' . $category . '%');
            });
        }

        // expiring soon
        if (!is_null($sortBy) && $sortBy === 'expiring_soon') {

            $query->where('deal_expired_at', '>', now())
                ->orderBy('deal_expired_at');
        }

        // best deal
        if (!is_null($sortBy) && $sortBy === 'best_deal') {

            $orderByColumn = 'price - sell_price';
            $query->orderBy(DB::raw($orderByColumn), 'desc');
        }

        if (!is_null($searchTerm)) {
            $searchTerm = strip_tags(trim($searchTerm));
            $query->where('title', 'LIKE', "%{$searchTerm}%");
        }

        if (!is_null($searchLocation)) {
            $searchLocation = strip_tags(trim($searchLocation));

            $query->where('location', 'LIKE', "%{$searchLocation}%");
        }

        if (!is_null($sortBy) && !is_null($sortOrder)) {
            $sortBy = strip_tags(trim($sortBy));

            if ($sortBy == 'price') {
                $query->orderBy(DB::raw('COALESCE(sell_price, price)'), $sortOrder);
            } else {
                $query->orderBy($sortBy, $sortOrder);
            }
        } else if ((is_null($sortBy) && !is_null($sortOrder)) && $sortOrder == 'desc') {
            $query->orderBy('id', 'desc');
        }else if($latitude && $longitude){
            $query->orderBy('distance', 'asc');
        } else {
            $query->orderBy('id', 'desc');
        }


        // wishlist flag
        if ($user_id) {
            $query->addSelect([
                'is_wishlist' => WishList::selectRaw('1')
                    ->whereColumn('product_id', 'products.id')
                    ->where('user_id', $user_id)
                    ->limit(1)
            ]);
        }

        $products = $query->paginate(5);
        return $this->jsonResponse(false, $this->success, $products, $this->emptyArray, JsonResponse::HTTP_OK);
    }


    /**
     * Suggest Company Location for product sort
     * @param \Illuminate\Http\Request $request
     * @return JsonResponse
     */
    public function locationList($name = NULL)
    {
        try {
            $uniqueLocations = [];

            if ($name) {
                $locationName = $name;

                $uniqueLocations = Cache::remember('unique_locations_' . $locationName, 3600, function () use ($locationName) {
                    $companies = Company::where('location', 'like', '%' . $locationName . '%')
                        ->select('location')
                        ->whereRaw('LOWER(location) LIKE ?', ['%' . strtolower($locationName) . '%'])
                        ->get();


                    return $companies->pluck('location')->unique()->values()->all();
                });
            }

            return $this->jsonResponse(false, $this->success, $uniqueLocations, $this->emptyArray, JsonResponse::HTTP_OK);
        } catch (\Throwable $th) {
            return $this->jsonResponse(true, 'No location found!', $name, [$th->getMessage()], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store product with product variants
     * @param \Illuminate\Http\Request $request
     * @return JsonResponse
     */
    public function store(ProductAddRequest $request): JsonResponse
    {
        try {

            $company = Company::find($request->company_id);
            $user = User::findOrFail($company->user_id);

            if ($user->id == auth()->user()->id) {
                $product = ProductProcess::create($request);

                if (isset($request->product_variants) && count($request->product_variants) > 0) {
                    foreach ($request->product_variants as $productVariant) {
                        $productVariant['user_id'] = auth()->user()->id;
                        $productVariant['company_id'] = $product->company_id;
                        $productVariant['product_id'] = $product->id;
                        ProductVariantProcess::create($productVariant);
                    }
                }

                $product = Product::with(['productVariants'])->find($product->id);

                // notification create for new product create
                Notification::create([
                    'creator_id' => auth()->user()->id,
                    'receiver_id' => $product->company_id,
                    'action_id' => $product->id,
                    'type' => 'create',
                    'action_link' => "Product",
                    'message' => "New Product Created",
                    'status' => 1,
                    'role' => 'admin,client'
                ]);


                return $this->jsonResponse(false, 'Product created Successfully', $product, [], JsonResponse::HTTP_CREATED);
            } else {
                return $this->jsonResponse(true, 'Unauthorized user', $request->all(), [], JsonResponse::HTTP_UNAUTHORIZED);
            }
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
        $product = Product::with(['productVariants'])->where('id', $id)->first();
        // selected categories for product edit
        $cats = json_decode($product->cats);
        $categories = Category::whereIn('id', $cats)->get();
        $product->selected_categories = $categories;

        if (!empty($product)) {

            return $this->jsonResponse(false, $this->success, $product, $this->emptyArray, JsonResponse::HTTP_OK);
        } else {

            return $this->jsonResponse(true, $this->failed, $this->emptyArray, ['Product not found'], JsonResponse::HTTP_NOT_FOUND);
        }
    }

    /**
     * Update product & product variants
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function updateProduct(UpdateRequest $request, $id): JsonResponse
    {
        try {
            $product = Product::find($id);


            if (!empty($product)) {

                $product = ProductProcess::update($request, $id);

                $arrayofProductVariantId = ProductVariant::where('product_id', $id)->pluck('id')->toArray();

                $deletableProductVariant = $this->updateProductVariant($request, $product, $arrayofProductVariantId);

                ProductVariant::whereIn('id', $deletableProductVariant)->delete();

                if (isset($product->productVariants)) {
                    $product->productVariants;
                }

                // notification create for new product create
                Notification::create([
                    'creator_id' => auth()->user()->id,
                    'receiver_id' => $product->company_id,
                    'action_id' => $product->id,
                    'type' => 'updated',
                    'action_link' => "Product",
                    'message' => "Product Updated",
                    'status' => 1,
                    'role' => 'admin'
                ]);

                return $this->jsonResponse(false, "Product updated successfully", $product, $this->emptyArray, JsonResponse::HTTP_OK);
            } else {
                return $this->jsonResponse(false, $this->failed, ['Product not found'], $this->emptyArray, JsonResponse::HTTP_NOT_FOUND);
            }
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

        $query = Product::with(['productVariants', 'company']);

        if (!is_null($request->company)) {
            $query->where('company_id', $request->company);
        }
        $product = $query->find($id);

        $mainReviews =  Review::with(['likes', 'dislikes'])
            ->where('product_id', $product->id)
            ->where('status', false)
            ->with('user.personalInfo', 'likeStatus')
            ->get()
            ->toArray();

        $ids = array_column($mainReviews, 'id');
        $reviews = array_combine($ids, $mainReviews);

        $mainReviews = [];

        foreach ($reviews as $review) {
            if ($review['replies_to']) {
                $reviews[$review['replies_to']]['reply'][] = $review;
            }
        }

        $filteredReview = [];

        foreach ($reviews as $item) {
            if (!isset($item['replies_to']) || $item['replies_to'] === null) {
                $filteredReview[] = $item;
            }
        }

        if (!empty($product)) {

            return $this->jsonResponse(false, $this->success, ['product' => $product, 'reviews' => $filteredReview], $this->emptyArray, JsonResponse::HTTP_OK);
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

        $products = Company::with(['user.personalInfo', 'products' => function ($query) {
            $query->with(['reviews' => function ($q) {
                $q->with(['likes', 'dislikes']);
            }]);
        }, 'reviews'])
            ->where('id', $companyId)
            ->first();

        $user_id = auth()->user() ? auth()->user()->id : null;

        if ($user_id) {
            // Map through each product and add the is_wishlist attribute
            $products->products->map(function ($product) use ($user_id) {
                $isWishlist = WishList::where('product_id', $product->id)
                    ->where('user_id', $user_id)
                    ->exists();
                $product->is_wishlist = $isWishlist;
                return $product;
            });
        }

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
        $product = Product::with(['productVariants'])
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
     * Delete product with product variants
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id)
    {

        $product = Product::where('user_id', Auth::id())->where('id', $id)->first();

        //delete product images
        if (isset($product->images)) {
            $arrayOfImages = explode(',', $product->images);
            $this->deleteFile("public", $arrayOfImages);
        }

        //delete product variant images
        if (isset($product->productVariants)) {
            foreach ($product->productVariants as $proVariant) {
                $arrayOfImages = explode(',', $proVariant->images);
                $this->deleteFile("public", $arrayOfImages);
            }
        }

        if (!empty($product)) {
            ProductVariant::whereIn('product_id', [$product->id])->delete();

            // notification create for new product create
            Notification::create([
                'creator_id' => auth()->user()->id,
                'receiver_id' => $product->company_id,
                'action_id' => "#",
                'type' => 'deleted',
                'action_link' => "Product",
                'message' => "Product Deleted",
                'status' => 1,
                'role' => 'admin'
            ]);

            $product->delete();

            return $this->jsonResponse(false, 'Product deleted successfully', $product, $this->emptyArray, JsonResponse::HTTP_OK);
        } else {

            return $this->jsonResponse(true, $this->failed, $this->emptyArray, ['Product not found'], JsonResponse::HTTP_NOT_FOUND);
        }
    }

    /**
     * @param $request
     * @param $product
     * @param $arrayofProductVariantId
     * @return array
     */
    protected function updateProductVariant($request, $product, $arrayofProductVariantId): array
    {
        if (isset($request->product_variants)) {
            foreach ($request->product_variants as $ProductVariant) {
                if (isset($ProductVariant['id']) && in_array($ProductVariant['id'], $arrayofProductVariantId)) {

                    $ProductVariant['user_id'] = auth()->user()->id;
                    $ProductVariant['company_id'] = $product->company_id;
                    $ProductVariant['product_id'] = $product->id;

                    ProductVariantProcess::update($ProductVariant, $ProductVariant['id']);
                    $key = array_search($ProductVariant['id'], $arrayofProductVariantId);
                    if ($key !== false) {
                        unset($arrayofProductVariantId[$key]);
                    }
                } else {
                    $ProductVariant['user_id'] = auth()->user()->id;
                    $ProductVariant['company_id'] = $product->company_id;
                    $ProductVariant['product_id'] = $product->id;

                    ProductVariantProcess::create($ProductVariant);
                }
            }
        }

        return $arrayofProductVariantId;
    }

    public function decodeProductImage($product)
    {
        if (isset($product->images)) {
            $product->images = json_decode($product->images);
        }

        if (isset($product->productVariants)) {
            foreach ($product->productVariants as $proVarient) {
                if (isset($proVarient->images)) {
                    $proVarient->images = json_decode($proVarient->images);
                }
            }
        }
    }

    // banner for client
    public function homeBanner(Request $request)
    {

        $userId = $request->user_id;
        $banner = '';

        if (!$userId) {
            $banner = AppBanner::where('banner_type', 'guest')->first();
        } else {
            $LoggedUser = User::find($userId);

            if ($LoggedUser->roles->contains('slug', 'client')) {
                $banner = AppBanner::where('banner_type', 'client')->first();
            } elseif ($LoggedUser->roles->contains('slug', 'company')) {
                $banner = AppBanner::where('banner_type', 'company')->first();
            } else {
                $banner = AppBanner::where('banner_type', 'guest')->first();
            }
        }

        if (!empty($banner)) {

            return $this->jsonResponse(false, $this->success, $banner, $this->emptyArray, JsonResponse::HTTP_OK);
        } else {

            return $this->jsonResponse(true, $this->failed, $this->emptyArray, ['Banner not found'], JsonResponse::HTTP_NOT_FOUND);
        }
    }
}

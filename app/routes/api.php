<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HydraController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserRoleController;

use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ProductVariantController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\VerificationController;
use App\Http\Controllers\API\ForgotPasswordController;
use App\Http\Controllers\API\ClientController;
use App\Http\Controllers\API\ReviewController;
use App\Http\Controllers\API\WishlistController;
use App\Http\Controllers\API\SubscriptionController;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//use the middleware 'hydra.log' with any request to get the detailed headers, request parameters and response logged in logs/laravel.log

Route::get('hydra', [HydraController::class, 'hydra']);
Route::get('hydra/version', [HydraController::class, 'version']);

Route::apiResource('users', UserController::class)->except(['edit', 'create', 'store', 'update'])->middleware(['auth:sanctum', 'ability:admin,super-admin']);

Route::post('users', [UserController::class, 'store']);
Route::put('users/{user}', [UserController::class, 'update'])->middleware(['auth:sanctum', 'ability:admin,super-admin,user']);
Route::post('users/{user}', [UserController::class, 'update'])->middleware(['auth:sanctum', 'ability:admin,super-admin,user']);
Route::patch('users/{user}', [UserController::class, 'update'])->middleware(['auth:sanctum', 'ability:admin,super-admin,user']);
Route::put('users/update-password/{user}', [UserController::class, 'updatePassword'])->middleware(['auth:sanctum']);

Route::get('me', [UserController::class, 'me'])->middleware(['auth:sanctum']);
Route::post('login', [UserController::class, 'login']);
Route::post('login/{social_platform}', [UserController::class, 'loginWithGoogle']);

Route::apiResource('roles', RoleController::class)->except(['create', 'edit'])->middleware(['auth:sanctum', 'ability:admin,super-admin,user']);
Route::apiResource('users.roles', UserRoleController::class)->except(['create', 'edit', 'show', 'update'])->middleware(['auth:sanctum', 'ability:admin,super-admin']);

Route::middleware(['auth:sanctum'])->group(function () {

    Route::prefix('client')->name('api.client.')->group(function () {
        Route::get('location/{name?}', [ProductController::class, 'locationList']);
        Route::get('category', [CategoryController::class, 'index']);

        Route::get('product', [ProductController::class, 'index']);
        Route::get('product/{product}', [ProductController::class, 'productDetails']);
        Route::get('/{company}/products', [ProductController::class, 'getProductsOfCompany']);
        
        Route::get('profile', [ClientController::class, 'profile']);
        Route::post('profile', [ClientController::class, 'profileUpdate']);
        Route::post('security/settings', [ClientController::class, 'securitySettings']);

        Route::get('reviews/{company}', [ReviewController::class, 'reviewsOfCompany']);
        Route::post('review', [ReviewController::class, 'reviewOfProduct']);
        Route::post('review/like', [ReviewController::class, 'likeOfReview']);
        Route::post('review/dislike', [ReviewController::class, 'dislikeOfReview']);
        Route::post('review/reply', [ReviewController::class, 'replyOfReview']);

        Route::get('wishlist', [WishlistController::class, 'wishList']);
        Route::post('wishlist', [WishlistController::class, 'addtoWishList']);
        Route::get('wishlist/remove/{id}', [WishlistController::class, 'removeFromWishlist']);

    });
});


Route::middleware(['auth:sanctum'])->group(function () {

    Route::prefix('company')->name('api.company.')->group(function () {
        Route::get('location/{name?}', [ProductController::class, 'locationList']);
        Route::get('category', [CategoryController::class, 'index']);

        Route::get('product', [ProductController::class, 'index'])->name('product.list');
        Route::post('product', [ProductController::class, 'store']);
        Route::get('product/{product}/edit', [ProductController::class, 'editProduct']);
        Route::post('product/{product}', [ProductController::class, 'updateProduct']);
        Route::get('product/destroy/{id}', [ProductController::class, 'destroy']);

        Route::get('/{company}/products', [ProductController::class, 'getProductsOfCompany']);
        Route::get('product/{product}', [ProductController::class, 'productDetails']);

        Route::get('profile', [ClientController::class, 'profile']);
        Route::post('profile', [ClientController::class, 'profileUpdate']);
        Route::post('security/settings', [ClientController::class, 'securitySettings']);

        Route::get('reviews/{company}', [ReviewController::class, 'reviewsOfCompany']);
        Route::get('review/accept', [ReviewController::class, 'reviewAcceptReject']);
        Route::post('review/like', [ReviewController::class, 'likeOfReview']);
        Route::post('review/dislike', [ReviewController::class, 'dislikeOfReview']);
        Route::post('review/reply', [ReviewController::class, 'replyOfReview']);

        Route::get('wishlist', [WishlistController::class, 'wishList']);
        Route::post('wishlist', [WishlistController::class, 'addtoWishList']);
        Route::get('wishlist/remove/{id}', [WishlistController::class, 'removeFromWishlist']);

        Route::get('subscription-packages', [SubscriptionController::class, 'index']);  
        Route::post('purchase/request', [SubscriptionController::class, 'handlePaymentRequest']); 

    });
});

Route::post('/verify-email/{user}/{code}', [VerificationController::class, 'verify'])->name('verify.email');
Route::post('/resend-verification/{user}', [VerificationController::class, 'resend'])->name('verify.resend');
Route::post('forgot-password', [ForgotPasswordController::class, 'forgotPassword'])->name('password.forgot');
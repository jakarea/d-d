<?php

use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ProductVarientController;
use App\Http\Controllers\HydraController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserRoleController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\VerificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('me', [UserController::class, 'me'])->middleware('auth:sanctum');
Route::post('login', [UserController::class, 'login']);

Route::apiResource('roles', RoleController::class)->except(['create', 'edit'])->middleware(['auth:sanctum', 'ability:admin,super-admin,user']);
Route::apiResource('users.roles', UserRoleController::class)->except(['create', 'edit', 'show', 'update'])->middleware(['auth:sanctum', 'ability:admin,super-admin']);

Route::middleware(['auth:sanctum', 'ability:admin,super-admin,user'])->group(function () {

    Route::prefix('client')->name('api.client.')->group(function () {
        Route::apiResource('category', CategoryController::class);
        Route::apiResource('product', ProductController::class);
        Route::get('search/product',[ProductController::class,'searchProduct']);
    });
});

Route::get('company/{company}/products', [ProductController::class, 'getProductsofCompany'])->middleware(['auth:sanctum', 'ability:admin,super-admin,user']);
Route::get('company/{company}/product/{product}', [ProductController::class, 'companyProductDetails'])->middleware(['auth:sanctum', 'ability:admin,super-admin,user']);


Route::apiResource('product-varient', ProductVarientController::class)->middleware(['auth:sanctum', 'ability:admin,super-admin,user']);
Route::get('product/{product}/product-varients',[ProductVarientController::class,'getProductVarientofProduct'])->middleware(['auth:sanctum', 'ability:admin,super-admin,user']);

Route::get('/verify-email/{user}/{code}', [VerificationController::class, 'verify'])->name('verify.email');
Route::get('/resend-verification/{user}', [VerificationController::class, 'resend'])->name('verify.resend');

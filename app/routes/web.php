<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\EarningController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MarketPlaceController;
use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\API\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\API\SubscriptionController;
use App\Http\Controllers\AppBannerController;
use App\Http\Controllers\LandingPageController; 

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// landing page and froentend route
Route::prefix('/')->controller(LandingPageController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/home', 'home')->name('home.main');  
    Route::get('/products', 'productList')->name('home.product.list');  
    Route::get('products/{slug}', 'productDetails')->name('home.product.details');  
    Route::get('/privacy-policy', 'privacyPolicy')->name('home.privacy.policy');  
    Route::get('/terms-condition', 'termsCondition')->name('home.terms.condition');  
}); 

// auth route
Route::group(['middleware' => ['guest']], function () {
    // Registration
    Route::get('/register', [AuthController::class,'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class,'register']);

    // Login
    Route::get('/login', [AuthController::class,'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class,'login']);
});

// forgot password handle routes for mobile app user and dashboard
Route::group(['middleware' => ['web']], function () {

    // send request form - app
    Route::get('password/reset', [ResetPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [ResetPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

    // password update form - web, app
    Route::get('password/reset/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [ForgotPasswordController::class, 'resetPassword'])->name('password.update');

    // admin pssword success cancel message
    Route::get('password/success', [ResetPasswordController::class, 'showSuccessPage'])->name('password.success');
    Route::get('password/cancel', [ResetPasswordController::class, 'showFailPage'])->name('password.cancel');

    // purchase package payment status route view for mobile app users
    Route::get('/purchase/package', [SubscriptionController::class, 'packageList'])->name('purchase.packages.web');
    Route::get('api/purchase/success', [SubscriptionController::class, 'handleSuccess'])->name('purchase.success');
    Route::post('api/purchase/cancel', [SubscriptionController::class, 'handleCancel'])->name('purchase.cancel');
});


// dashboard redirection
Route::group(['middleware' => ['auth','isAdmin']], function () { 
    Route::get('/dashboard', function () { redirect('/analytics'); });
});

// main dashboard routes
Route::group(['middleware' => ['auth','isAdmin']], function () {

    // app banner
    Route::prefix('banner')->controller(AppBannerController::class)->group(function () {
        Route::get('/list', 'index')->name('banner.list');
        Route::post('/store', 'store')->name('banner.store');
    });

    // category route
    Route::resource('/category', CategoryController::class);
    // marketplace route
    Route::prefix('marketplace')->controller(MarketPlaceController::class)->group(function () {
        Route::get('/', 'index')->name('product.list');
        Route::get('/{slug}', 'show')->name('product.show');
        Route::get('/{slug}/edit', 'edit')->name('product.edit');
        Route::post('/{slug}/edit', 'update')->name('product.update');
    });
    // company route
    Route::resource('/company', CompanyController::class);
    // customer route
    Route::resource('/users', CustomerController::class);
    Route::get('/users/{id}/edit/address', [CustomerController::class, 'editAddress'])->name('users.editAddress');
    Route::post('/users/{id}/edit/address', [CustomerController::class, 'updateAddress'])->name('users.updateAddress');
    // analytics route
    Route::get('/analytics', [AnalyticsController::class, 'analytics']);
    // earning route
    Route::get('/earning', [EarningController::class, 'index']);
    Route::get('/earning/{id}', [EarningController::class, 'show']);
    Route::get('earning/generate-pdf/{id}', [EarningController::class,'generatePdf']);

    // package subscription route
    Route::get('/packages', [PackageController::class, 'index'])->name('pricing.packages');
    Route::get('/packages-update', [PackageController::class, 'edit'])->name('pricing.package.edit');
    Route::post('/packages-update/{id}', [PackageController::class, 'update'])->name('pricing.package.update');
    // advertisment route
    Route::get('/advertisement', [AdvertisementController::class, 'index'])->name('advertise.products');
    // admin profile route
    Route::prefix('account')->controller(AdminProfileController::class)->group(function () {
        Route::get('/my-profile', 'index')->name('admin.profile');
        Route::get('/edit-profile', 'edit')->name('admin.profile.edit');
        Route::get('/security-setting', 'passwordSetting')->name('admin.security.setting');
        Route::post('/security-setting', 'passwordUpdate')->name('admin.security.update');
        Route::post('/edit-profile', 'update')->name('admin.profile.update');
        Route::get('/edit-address', 'editAddress')->name('admin.profile.address.edit');
        Route::post('/edit-address', 'updateAddress')->name('admin.profile.address.update');
        // notification routes
        Route::get('/notifications', 'notifications')->name('admin.notification.system');
    });

    // logout route
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

});

// all cache clear route
Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('clear-compiled');
    Artisan::call('storage:link');
    return redirect('/');
});



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
use App\Http\Controllers\API\ForgotPasswordController;
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


Route::group(['middleware' => ['guest']], function () {
    // Registration
    Route::get('/register', [AuthController::class,'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class,'register']);

    // Login
    Route::get('/login', [AuthController::class,'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class,'login']);
});

Route::group(['middleware' => ['auth']], function () {

    // initial redirection route
    Route::get('/', function () {
        return redirect('/dashboard');
    });
    Route::get('/home', function () {
        return redirect('/dashboard');
    });

    // dashboard route
    Route::get('/dashboard', function () {
        return view('dashboard/index');
    });

    // marketplace route
    Route::prefix('marketplace')->controller(MarketPlaceController::class)->group(function () {
        Route::get('/', 'index')->name('product.list'); 
        Route::get('/{slug}', 'show')->name('product.show'); 
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

    // package subscription route
    Route::get('/packages', [PackageController::class, 'index'])->name('pricing.packages');
    Route::get('/packages-update', [PackageController::class, 'edit'])->name('pricing.package.edit');
    Route::post('/packages-update/{id}', [PackageController::class, 'update'])->name('pricing.package.update');

    // advertisement route
    Route::get('/advertisement', function () {
        return view('advertisement/index');
    });

    // admin profile route
    Route::get('/account/my-profile', function () {
        return view('admin-profile/details');
    });
    Route::get('/account/edit-profile', function () {
        return view('admin-profile/edit');
    });
    Route::get('/account/edit-address', function () {
        return view('admin-profile/edit-address');
    });

    // category route
    Route::resource('/category', CategoryController::class);

    // logout route
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
});


// forgot password handle routes for mobile app user
Route::group(['middleware' => ['web','guest']], function () {

    Route::get('api/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::get('api/reset-update', [ForgotPasswordController::class, 'showStatusPage'])->name('password.status');
    Route::post('reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('password.update');

});
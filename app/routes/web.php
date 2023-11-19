<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\EarningController;
use App\Http\Controllers\PackageController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['guest']], function () {
    
    // Registration
    Route::get('/register', [AuthController::class,'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class,'register']);

    // Login
    Route::get('/login', [AuthController::class,'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class,'login']);

});

Route::group(['middleware' => ['auth']], function () {

    Route::resource('/company', CompanyController::class);
    // Route::post('/company', [CompanyController::class,'store'])->name('company.store');
    // Route::get('/company/{id}', [CompanyController::class,'show'])->name('company.show');

    Route::resource('/customer', CustomerController::class);
    Route::get('/customer/{id}/edit/address', [CustomerController::class, 'editAddress'])->name('customer.editAddress');
    Route::post('/customer/{id}/edit/address', [CustomerController::class, 'updateAddress'])->name('customer.updateAddress');

    Route::get('/analytics', [AnalyticsController::class, 'index']);
    Route::get('/earning', [EarningController::class, 'index']);
    
    Route::get('/package', [PackageController::class, 'index']);

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
});
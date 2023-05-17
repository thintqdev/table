<?php

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ShopController;
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

// Auth
Route::prefix('admin/auth')->controller(AdminAuthController::class)->group(function () {
    Route::post('/login', 'login');
    Route::post('/forgot-password', 'forgotPassword');
    Route::post('/reset-password', 'resetPassword');
});

Route::middleware(['auth:sanctum'])->prefix('admin')->group(function () {

    // Profile
    Route::prefix('profile')->controller(ProfileController::class)->group(function () {
        Route::post('/change-password', 'changePassword');
    });

    // Shop
    Route::prefix('shops')->controller(ShopController::class)->group(function () {
        Route::post('/', 'create');
        Route::get('/', 'index');
        Route::put('/{shop}', 'update');
        Route::delete('/{shop}', 'destroy');
        Route::get('/{shop}', 'show');
    });

    // Category
    

});
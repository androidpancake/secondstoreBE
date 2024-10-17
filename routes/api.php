<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\BookingController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\ProductController;
use App\Http\Controllers\api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(AuthController::class)->group(function () {
    Route::post('register', 'register')->name('register');
    Route::post('login', 'login')->name('login');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('products', ProductController::class);
    Route::get('products/{product:slug}', [ProductController::class, 'show']);
    // Route::apiResource('category', CategoryController::class);
    Route::get('category/{categories:name}', [CategoryController::class, 'show'])->name('category.name'); // {nama DB:nama Kolom}
    Route::post('booking', [BookingController::class, 'cust_booking']);
    Route::controller(UserController::class)->group(function () {
        Route::get('user', 'index')->name('user.index');
        Route::post('user/saveItems', 'savedItems')->name('user.product.save');
        Route::delete('user/unsaveItems/{product_id}', 'unsavedItems')->name('user.product.unsave');
    });
});

<?php

use App\Http\Controllers\Comment\CommentController;
use App\Http\Controllers\Payment\PaymentController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Product\RateController;
use App\Http\Controllers\Product\RemoveProductImageController;
use App\Http\Controllers\Product\ScoreController;
use Illuminate\Support\Facades\Route;


// Product Routes
Route::apiResource('products', ProductController::class)->only(['index', 'show']);

Route::middleware(['auth:sanctum'])->group(function() {

    Route::apiResource('products', ProductController::class)->except(['index', 'show']);

    Route::delete('products/{product_id}/remove-image', [ProductController::class, 'delImg']);

    Route::post('products/{product_id}/rate-product', [RateController::class, 'store']);
});


// Payment Routes
Route::middleware(['auth:sanctum'])->group(function() {

    Route::post('products/{product}/payment', [PaymentController::class, 'store']);
});

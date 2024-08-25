<?php

use App\Http\Controllers\Product\OrderController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function() {
    Route::post('products/{product}/add-order', [OrderController::class, 'store']);
    Route::delete('products/{product}/delete-order', [OrderController::class, 'destroy']);
});


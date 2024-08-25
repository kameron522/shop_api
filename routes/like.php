<?php

use App\Http\Controllers\Product\LikeController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function() {
    Route::post('likes/{product_id}/add-like', [LikeController::class, 'store']);
    Route::apiResource('likes', LikeController::class)->only(['delete']);
});

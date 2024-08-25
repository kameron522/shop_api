<?php

use App\Http\Controllers\Comment\CommentController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function() {
    Route::post('products/{product_id}/add-comment', [CommentController::class, 'store']);
    Route::apiResource('comments', CommentController::class)->except(['store']);
});


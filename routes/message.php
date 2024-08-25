<?php

use App\Http\Controllers\Message\MessageController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function() {
    Route::post('users/{receiver_id}/send-message', [MessageController::class, 'store']);
    Route::apiResource('messages', MessageController::class)->except(['store']);
});



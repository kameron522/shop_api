<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\EmailVerifyController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\ResetController;
use App\Http\Controllers\User\ResetTokenController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;


Route::apiResource('users', UserController::class)->only(['show', 'store']);
Route::post('user/login', [AuthController::class, 'login'])->middleware(['throttle:10,1']);

Route::middleware(['auth:sanctum'])->group(function() {

    Route::apiResource('users', UserController::class)->except(['show', 'store','index']);
    Route::delete('users/{user}/remove-image', [UserController::class, 'delImg']);

    Route::delete('user/logout', [AuthController::class, 'logout']);
    Route::get('user/current-user', ProfileController::class);

    Route::get('user/current-user/shopping-cart' , CartController::class);

    Route::get('user/verify-email', [EmailVerifyController::class, 'SendOtpCode']);
    Route::get('user/confirm-email/{otp_token}', [EmailVerifyController::class, 'verify'])->name('verify');
});

Route::post('user/reset-password', [ResetController::class, 'SendResetPassLink']);
Route::post('user/set-new-password/{reset_token}', [ResetController::class, 'ResetPassword']); // Reset Password

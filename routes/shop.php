<?php

use App\Http\Controllers\Shop\ShopController;
use Illuminate\Support\Facades\Route;

Route::apiResource('shops', ShopController::class)->middleware(['auth:sanctum', 'IsAdminOrEmployee']);

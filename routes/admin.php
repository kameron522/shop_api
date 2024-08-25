<?php

use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Comment\CommentController;
use App\Http\Controllers\Product\RateController;
use App\Http\Controllers\User\Admin\AdminController;
use App\Http\Controllers\User\Employee\EmployeeController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;


Route::apiResource('categories', CategoryController::class)
    ->except('show')->middleware(['auth:sanctum', 'IsAdmin']);

Route::get('users', [UserController::class, 'index'])->middleware(['auth:sanctum', 'IsAdmin']);

Route::apiResource('employees', EmployeeController::class)->middleware(['auth:sanctum', 'IsAdmin']);


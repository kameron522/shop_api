<?php

use Illuminate\Support\Facades\Route;


Route::get('test', function () {
    return response()->json([
        'message' => "testing",
    ], status: 200);
});

/*
Route::fallback(function() {
    abort(404);
});
*/
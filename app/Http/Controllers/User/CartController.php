<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __invoke()
    {
        $user = auth()->user();
        return $user->orders;
    }
}

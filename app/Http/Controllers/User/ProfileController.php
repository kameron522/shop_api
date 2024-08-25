<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __invoke()
    {
        $user = User::where('id', auth()->id())->get();
        return response()->json(['current user' => $user]);
    }
}

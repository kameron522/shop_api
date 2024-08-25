<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UserLoginRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function __construct(private AuthService $authService)
    {
    }

    public function login(UserLoginRequest $request)
    {
        $result = $this->authService->UserLogin($request);
        return $result;
    }

    public function logout()
    {
        $result = $this->authService->UserLogout();
        return $result;
    }
}

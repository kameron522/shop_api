<?php

namespace App\Services;

use App\Http\Controllers\User\LoginNotifController;
use App\Mail\SuccessLoginNotif;
use App\Mail\UnsuccessLoginNotif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Laravel\Sanctum\HasApiTokens;

class AuthService
{
    public function UserLogin(Request $request)
    {
        try
        {
            $email = request()->email;
            if (!auth()->attempt($request->validated()))
            {
                Mail::to(request()->email)->send(new UnsuccessLoginNotif($email));
                return response()->json(['error' => __('auth.failed')], status: 401);
            }
            $user = auth()->user();
            $token = $user->createToken($request->header('User-Agent'))->plainTextToken;
            Mail::to($email)->send(new SuccessLoginNotif($email));
        }
        catch(\Throwable $th)
        {
            return response()->json(['error' => $th->getMessage()], status: 500);
        }

        return response()->json(['user' => $user->name, 'token' => $token, 'message' => 'User logged in']);
    }

    public function UserLogout()
    {
        try
        {
            auth()->user()->currentAccessToken()->delete();
        }
        catch (\Throwable $th)
        {
            return response()->json(['error' => $th->getMessage()], status: 500);
        }

        return response()->json(['message' => 'User logged out!'], status: 200);
    }
}

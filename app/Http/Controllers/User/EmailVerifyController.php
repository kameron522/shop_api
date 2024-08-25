<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\VerificationEmail;
use App\Models\Otp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Throwable;

class EmailVerifyController extends Controller
{
    public function GenerateToken()
    {
        try
        {
            function UniqToken()
            {
                $otp_token = md5(rand());
                foreach (Otp::all() as $otp)
                {
                    if ($otp_token === $otp->token)
                        return 0;
                }
                return $otp_token;
            }

            while (true)
            {
                $result = UniqToken();
                if ($result)
                    return $result;
            }
        }
        catch(Throwable $th)
        {
            return response()->json(['error' => $th->getMessage()], status: 500);
        }

    }

    public function SendOtpCode()
    {
        try
        {
            $otp = Otp::create();
            $otp->token = $this->GenerateToken();
            $otp->user_id = auth()->id();
            $otp->save();

            $otp_token = $otp->token;
            Mail::to(auth()->user()->email)->send(new VerificationEmail($otp_token));
            return response()->json(['message' => 'an email was sent to you!'],status: 200);
        }
        catch(Throwable $th)
        {
            return response()->json(['error' => $th->getMessage()],status: 500);
        }

    }

    public function verify(string $otp_token)
    {
        try
        {
            foreach (Otp::all() as $otp)
            {
                if ($otp_token === $otp->token)
                {
                    $user = auth()->user();
                    $user->email_verified_at = date_default_timezone_get();

                    $user->save();
                    return response()->json(['message' => 'your email verified!']);
                }
            }
            return response()->json(['error' => 'invalid link!'], status: 404);
        }
        catch(Throwable $th)
        {
            return response()->json(['error' => $th->getMessage()],status: 500);
        }

    }
}

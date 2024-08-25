<?php

// Reset Password Controller

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\ResetPass;
use App\Mail\ResetPassEmail;
use App\Models\Reset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Throwable;

use function PHPUnit\Framework\returnSelf;

class ResetController extends Controller
{
    public function GenerateToken()
    {
        try
        {
            function UniqeToken()
            {
                $token = md5(rand());
                foreach(Reset::all() as $rs)
                {
                    if ($token === $rs->token)
                        return 0;
                }
                return $token;
            }

            while(true)
            {
                $result = UniqeToken();
                if ($result)
                    return $result;
            }
        }
        catch(Throwable $th)
        {
            return response()->json(['error' => $th->getMessage()],status: 500);
        }

    }

    public function SendResetPassLink()
    {
        try
        {
            $reset = Reset::create();
            $reset->token = $this->GenerateToken();
            $user_id = (User::where('email', request()->email)->firstOrFail())->id;
            $reset->user_id = $user_id;
            $reset->save();

            $final_token = $reset->token;
            $user = User::where('email', request()->email)->firstOrFail();
            if ($user)
                Mail::to(request()->email)->send(new ResetPassEmail($final_token));
            return response()->json(['If you submmited correctly, link will be sent to you'], status:200);
        }
        catch(Throwable $th)
        {
            return response()->json(['error' => $th->getMessage()],status: 500);
        }

    }

    public function ResetPassword(string $reset_token)
    {
        try
        {
            if (!(request()->password))
                return response()->json(['error' => 'you must set a password!'], status: 422);

            foreach(Reset::all() as $tk)
            {
                if ($reset_token === $tk->token)
                {
                    $reset_token = Reset::where('token', $reset_token)->firstOrFail();
                    $user_id = $reset_token->user_id;
                    $user = User::where('id', $user_id)->firstOrFail();
                    $user->password = Hash::make(request()->password);
                    $user->save();

                    return response()->json(['message' => 'password changed successfully']);
                }
            }
        }
        catch(Throwable $th)
        {
            return response()->json(['error' => $th->getMessage()],status: 500);
        }
    }
}

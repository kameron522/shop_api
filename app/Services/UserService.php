<?php

namespace App\Services;

use App\Base\ServiceWrapper;
use App\Base\Traits\UserTraits\UserUuidGenerator;
use App\Base\Traits\UuidGenerator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserService
{
    use UuidGenerator;

    public function GetALlUsers()
    {
        return app(ServiceWrapper::class)(fn() => User::latest()->get());
    }

    public function RegisterUser(array $inputs)
    {
        return app(ServiceWrapper::class)(
            function() use($inputs)
            {
                $inputs['password'] = Hash::make($inputs['password']);
                $user = User::create($inputs);
                $user->save();
                return $user;
            },
            'User Registered!'
        );
    }

    public function ShowUser(object $user)
    {
        return app(ServiceWrapper::class)(fn() => $user);
    }

    public function UpdateUser(array $inputs, object $user)
    {
        return app(ServiceWrapper::class)(
            function() use($user, $inputs)
            {
                $inputs['password'] = Hash::make($inputs['password']);
                $user->update($inputs);
                return $user;
            },
            'User Updated on Records!'
        );
    }

    public function DeleteUser(object $user)
    {
        return app(ServiceWrapper::class)(
            function() use($user)
            {
                if ($user->image)
                    Storage::disk('liara')->delete($user->image);
                return $user->delete();
            }
        );
    }
}

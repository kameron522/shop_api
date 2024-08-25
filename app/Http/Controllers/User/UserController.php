<?php

namespace App\Http\Controllers\User;

use App\Base\Traits\DeleteImage;
use App\Base\Traits\FinalValidation;
use App\Base\Traits\VerfiyUserEmail;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserDeleteRequest;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(private UserService $userService)
    {
    }

    public function index()
    {
        $result = $this->userService->GetALlUsers();
        return $result;
    }

    public function store(UserStoreRequest $request)
    {
        $result = $this->userService->RegisterUser(FinalValidation::isImageInRequest($request, 'User'));
        return $result;
    }


    public function show(User $user)
    {
        $result = $this->userService->ShowUser($user);
        return $result;
    }


    public function update(UserUpdateRequest $request, User $user)
    {
        $result = $this->userService->UpdateUser(FinalValidation::isImageInRequest($request, 'User' , $user), $user);
        return $result;
    }


    public function destroy(UserDeleteRequest $request, User $user)
    {
        $result = $this->userService->DeleteUser($user);
        return $result;
    }

    public function delImg($user_id)
    {
        $user = User::where('id', $user_id)->firstOrFail();
        $result = DeleteImage::PerformDelete($user);
        return $result;
    }
}

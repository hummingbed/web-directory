<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseMessages;
use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\AuthRegisterRequest;
use App\Services\UserService;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use HttpResponses;

    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(AuthRegisterRequest $request)
    {
        $data  = $this->userService->registerUser($request);
        return $this->successHttpMessage(
            $data,
            ResponseMessages::getSuccessMessage('User'),
            201
        );
    }

    public function login(AuthLoginRequest $request)
    {
        $token = $this->userService->loginUser($request);
        return $this->successHttpMessage(
            $token,
            ResponseMessages::getSuccessMessage('token', 'generated'),
        );
    }

    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();
        return $this->successHttpMessage(
            null,
            ResponseMessages::getSuccessMessage('token', 'deleted'),
        );
    }
}

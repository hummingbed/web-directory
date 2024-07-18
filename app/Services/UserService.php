<?php

namespace App\Services;

use App\Exceptions\UnprocessableEntityException;
use App\Helpers\ResponseMessages;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserService extends BaseService
{

    public function __construct(UserRepository $repository)
    {
        $this->repo = $repository;
    }

    public function registerUser($request)
    {
        $this->repo->insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => empty($request->role) ? 'user' : $request->role,
        ]);
        return true;
    }

    public function getUserByEmail($email)
    {
        return $this->repo->findFirst(['email' => $email]);
    }

    public function loginUser($request): string
    {
        $user = $this->getUserByEmail($request->email);
        throw_if(!$user || !Hash::check($request->password, $user->password),
            new UnprocessableEntityException(ResponseMessages::unprocessableEntityMessage('credentials'))
        );
        $user->update(['last_login' => now()]);
        return $user->createToken($request->email)->plainTextToken;
    }

}

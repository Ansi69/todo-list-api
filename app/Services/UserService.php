<?php

namespace App\Services;

use App\Models\User;
use App\Services\Abstracts\UserServiceInterface;

class UserService implements UserServiceInterface
{
    public function __construct(
    )
    {
    }

    /**
     * @param User $user
     * @return string
     */
    public function createAccessToken(User $user): string
    {
        return $user->createToken('auth_token')->plainTextToken;
    }
}

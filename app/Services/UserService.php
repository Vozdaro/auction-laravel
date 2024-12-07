<?php

declare(strict_types=1);

namespace App\Services;

use App\Dto\UserStoreDto;
use App\Models\User;
use App\Services\Contracts\UserServiceInterface;

class UserService implements UserServiceInterface
{
    public function store(UserStoreDto $userStoreDto): ?User
    {
        return User::create([
            'name'     => $userStoreDto->name,
            'email'    => $userStoreDto->email,
            'password' => $userStoreDto->password,
        ]);
    }
}

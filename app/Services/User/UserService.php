<?php

declare(strict_types=1);

namespace App\Services\User;

use App\Dto\User\UserStoreDto;
use App\Models\User;
use App\Services\User\Contracts\UserServiceInterface;
use Illuminate\Support\Facades\Hash;

final class UserService implements UserServiceInterface
{
    public function store(UserStoreDto $userStoreDto): ?User
    {
        return User::create([
            'name'     => $userStoreDto->name,
            'email'    => $userStoreDto->email,
            'password' => Hash::make($userStoreDto->password),
        ]);
    }
}

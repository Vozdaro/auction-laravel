<?php

declare(strict_types=1);

namespace App\Services\User;

use App\DTO\User\UserStoreDto;
use App\Models\User;
use App\Services\User\Contracts\UserServiceInterface;
use Illuminate\Auth\Events\Registered;

final class UserService implements UserServiceInterface
{
    /**
     * @inheritdoc
     */
    public function store(UserStoreDto $userStoreDto): User
    {
        $user = User::create([
            'name'         => $userStoreDto->name,
            'email'        => $userStoreDto->email,
            'password'     => $userStoreDto->password,
            'contact_info' => $userStoreDto->contact_info
        ]);

        event(new Registered($user));

        return $user;
    }
}

<?php

declare(strict_types=1);

namespace App\Services\User;

use App\DTO\User\UserStoreDto;
use App\Models\User;
use App\Models\UserProfile;
use App\Services\User\Contracts\UserServiceInterface;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\DB;

final class UserService implements UserServiceInterface
{
    /**
     * @inheritdoc
     */
    public function store(UserStoreDto $userStoreDto): User
    {
        DB::beginTransaction();
        $user = User::create([
            'name'     => $userStoreDto->name,
            'email'    => $userStoreDto->email,
            'password' => $userStoreDto->password
        ]);

        $userProfile = UserProfile::create([
            'user_id'      => $user->id,
            'contact_info' => $userStoreDto->contact_info
        ]);
        DB::commit();
        event(new Registered($user));

        return $user;
    }
}

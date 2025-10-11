<?php

declare(strict_types=1);

namespace App\Services\User;

use App\DTO\User\UserStoreDto;
use App\Enum\ReplicationPostfixEnum;
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
        $masterUser = null;

        foreach (ReplicationPostfixEnum::toArray() as $connectionPostfix) {
            DB::connection("mysql_$connectionPostfix")->beginTransaction();
            $user = User::on("mysql_$connectionPostfix")->create([
                'name'     => $userStoreDto->name,
                'email'    => $userStoreDto->email,
                'password' => $userStoreDto->password
            ]);

            $userProfile = UserProfile::on("mysql_$connectionPostfix")->create([
                'user_id'      => $user->id,
                'contact_info' => $userStoreDto->contact_info
            ]);
            DB::connection("mysql_$connectionPostfix")->commit();

            if ($connectionPostfix === 'master') {
                event(new Registered($user));
                $masterUser = $user;
            }
        }

        return $masterUser;
    }
}

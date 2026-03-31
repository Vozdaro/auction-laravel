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
use Throwable;

final class UserService implements UserServiceInterface
{
    /**
     * @inheritDoc
     * @throws Throwable
     */
    public function store(UserStoreDto $userStoreDto, bool $seedMode = false): User
    // todo: подумать над тем чтобы сделать метод store из всех репозиториев в абстрактный
    {
        $masterUser = null;

        foreach (ReplicationPostfixEnum::toArray() as $connectionPostfix) {
            DB::connection("pgsql_$connectionPostfix")->beginTransaction();
            $user = User::on("pgsql_$connectionPostfix")->create([
                'name'     => $userStoreDto->name,
                'email'    => $userStoreDto->email,
                'password' => $userStoreDto->password,
                'is_admin' => $userStoreDto->is_admin
            ]);

            UserProfile::on("pgsql_$connectionPostfix")->create([
                'user_id'      => $user->id,
                'contact_info' => $userStoreDto->contact_info
            ]);
            DB::connection("pgsql_$connectionPostfix")->commit();

            if ($connectionPostfix === ReplicationPostfixEnum::Master->value) {
                !$seedMode && event(new Registered($user));
                $masterUser = $user;
            }
        }

        return $masterUser;
    }
}

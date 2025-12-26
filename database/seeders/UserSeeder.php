<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Dto\User\UserStoreDto;
use App\Services\User\Contracts\UserServiceInterface;
use Illuminate\Database\Seeder;

final class UserSeeder extends Seeder
{
    public const ADMIN_EMAIL = 'admin1@gmail.com';

    private const USERS = [
        [
            'name'         => 'admin1',
            'email'        => self::ADMIN_EMAIL,
            'password'     => '123',
            'contact_info' => 'contact 1',
            'is_admin'     => true
        ],
        [
            'name'         => 'admin2',
            'email'        => 'admin2@gmail.com',
            'password'     => '123',
            'contact_info' => 'contact 2',
            'is_admin'     => true
        ],
    ];


    /**
     * @param UserServiceInterface $userService
     */
    public function __construct(
        protected UserServiceInterface $userService,
    ) {
    }

    /**
     * @return void
     */
    public function run(): void
    {
        foreach (self::USERS as $user) {
            $userStoreDto = UserStoreDto::fromArray($user);
            $this->userService->store($userStoreDto);
        }
    }
}

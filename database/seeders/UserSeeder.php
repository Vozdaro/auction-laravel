<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Dto\User\UserStoreDto;
use App\Services\User\Contracts\UserServiceInterface;
use Illuminate\Database\Seeder;

final class UserSeeder extends Seeder
{
    private const USERS = [
        [
            'name' => 'admin1',
            'email' => 'admin1@gmail.com',
            'password' => '123',
            'contact_info' => 'contact 1'
        ],
        [
            'name' => 'admin2',
            'email' => 'admin2@gmail.com',
            'password' => '123',
            'contact_info' => 'contact 2'
        ],
    ];

    public function __construct(
        protected UserServiceInterface $userService,
    ) {
    }

    public function run(): void
    {
        foreach (self::USERS as $user) {
            $userStoreDto = UserStoreDto::fromArray($user);
            $this->userService->store($userStoreDto);
        }
    }
}

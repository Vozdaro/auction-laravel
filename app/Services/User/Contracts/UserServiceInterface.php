<?php

declare(strict_types=1);

namespace App\Services\User\Contracts;

use App\DTO\User\UserStoreDto;
use App\Models\User;

interface UserServiceInterface
{
    /**
     * @param UserStoreDto $userStoreDto
     * @return User
     */
    public function store(UserStoreDto $userStoreDto): User;
}

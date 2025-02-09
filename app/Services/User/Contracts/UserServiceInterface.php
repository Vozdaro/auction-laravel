<?php

declare(strict_types=1);

namespace App\Services\User\Contracts;

use App\Dto\User\UserStoreDto;
use App\Models\User;

interface UserServiceInterface
{
    public function store(UserStoreDto $userStoreDto): ?User;
}

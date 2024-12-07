<?php

declare(strict_types=1);

namespace App\Services\Contracts;

use App\Dto\UserStoreDto;
use App\Models\User;

interface UserServiceInterface
{
    public function store(UserStoreDto $userStoreDto): ?User;
}

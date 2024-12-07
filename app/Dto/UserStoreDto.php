<?php

declare(strict_types=1);

namespace App\Dto;

use App\Http\Requests\UserStoreRequest;

readonly class UserStoreDto
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
    ) {
    }

    public static function fromeRequest(UserStoreRequest $request): self
    {
        return new UserStoreDto(
            $request->name,
            $request->email,
            $request->password,
        );
    }
}

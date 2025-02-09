<?php

declare(strict_types=1);

namespace App\Dto\User;

use App\Http\Requests\Auth\UserStoreRequest;

final readonly class UserStoreDto
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
    ) {
    }

    public static function fromRequest(UserStoreRequest $request): self
    {
        return new UserStoreDto(
            $request->name,
            $request->email,
            $request->password,
        );
    }
}

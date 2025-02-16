<?php

declare(strict_types=1);

namespace App\DTO\User;

use App\Http\Requests\Auth\UserStoreRequest;

final readonly class UserStoreDto
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
        public string $contact_info,
    ) {
    }

    /**
     * @param UserStoreRequest $request
     * @return self
     */
    public static function fromRequest(UserStoreRequest $request): self
    {
        return new UserStoreDto(
            $request->name,
            $request->email,
            $request->passwordFlash,
            $request->contact_info,
        );
    }
}

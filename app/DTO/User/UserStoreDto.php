<?php

declare(strict_types=1);

namespace App\DTO\User;

use App\Http\Requests\Auth\UserStoreRequest;

final readonly class UserStoreDto
{
    /**
     * @param string $name
     * @param string $email
     * @param string $password
     * @param string $contact_info
     */
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
        return new self(
            $request->name,
            $request->email,
            $request->passwordFlash,
            $request->contact_info,
        );
    }
}

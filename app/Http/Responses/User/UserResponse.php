<?php

declare(strict_types=1);

namespace App\Http\Responses\User;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class UserResponse
{
    public static function build(User $user): JsonResponse
    {
        return new JsonResponse(
            [
                'name'       => $user->name,
                'email'      => $user->email,
                'created_at' => $user->created_at,
            ],
            Response::HTTP_CREATED
        );
    }
}

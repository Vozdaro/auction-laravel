<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

#[OA\Info(version: '1.0', title: 'Yeticave')]
#[OA\Components(securitySchemes: [
    new OA\SecurityScheme(
        securityScheme: 'bearerAuth',
        type: 'http',
        scheme: 'bearer'
    )
])]
abstract class AbstractController
{
    /**
     * @param Request $request
     * @return User
     * @throws AuthenticationException
     */
    protected function getUser(Request $request): User
    {
        $user = $request->user();

        if (!($user instanceof User)) {
            throw new AuthenticationException();
        }

        return $user;
    }
}

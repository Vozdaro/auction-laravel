<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;

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

<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\AbstractController;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

final class EmailVerificationController extends AbstractController
{
    /**
     * @return string
     */
    public function notice(): string
    {
        return '123';
    }

    /**
     * @param EmailVerificationRequest $request
     * @return RedirectResponse
     */
    public function verify(EmailVerificationRequest $request): RedirectResponse
    {
        $request->fulfill();

        return to_route('auth.login');
    }

    /**
     * @throws AuthenticationException
     */
    public function send(Request $request): RedirectResponse
    {
        $this->getUser($request)->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    }

}

<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Dto\User\UserStoreDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UserStoreRequest;
use App\Services\User\Contracts\UserServiceInterface;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

final class RegisteredUserController extends Controller
{
    public function __construct(
        protected UserServiceInterface $userService,
    ) {
    }

    public function create(): View
    {
        return view('auth.signup', [
            'pageTitle' => 'Регистрация',
        ]);
    }

    public function store(UserStoreRequest $request): RedirectResponse
    {
        $userStoreDto = UserStoreDto::fromRequest($request);
        if ($user = $this->userService->store($userStoreDto)) {
            event(new Registered($user));
        };

        return to_route('auth.create');
    }
}

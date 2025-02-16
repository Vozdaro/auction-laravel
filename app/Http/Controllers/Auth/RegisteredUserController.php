<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\DTO\User\UserStoreDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UserStoreRequest;
use App\Services\Category\Contracts\CategoryServiceInterface;
use App\Services\User\Contracts\UserServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

final class RegisteredUserController extends Controller
{
    public function __construct(
        protected UserServiceInterface $userService,
        protected CategoryServiceInterface $categoryService,
    ) {
    }

    public function create(): View
    {
        return view('auth.signup', [
            'pageTitle'  => 'Регистрация',
            'categories' => $this->categoryService->getAll(),
        ]);
    }

    public function store(UserStoreRequest $request): RedirectResponse
    {
        $userStoreDto = UserStoreDto::fromRequest($request);
        $this->userService->store($userStoreDto);

        return to_route('auth.login');
    }
}

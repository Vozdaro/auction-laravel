<?php

namespace App\Http\Controllers\Auth;

use App\Dto\UserStoreDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AutenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('auth.login', [
            'pageTitle' => 'Вход',
        ]);
    }

//    public function store(UserStoreRequest $request): RedirectResponse
//    {
//        $userStoreDto = UserStoreDto::fromeRequest($request);
//        if ($user = $this->userService->store($userStoreDto)) {
//            event(new Registered($user));
//        };
//
//
//        return to_route('auth.create');
//    }
}

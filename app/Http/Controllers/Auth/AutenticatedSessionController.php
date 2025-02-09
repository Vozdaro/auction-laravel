<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UserLoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

final class AutenticatedSessionController extends Controller
{
    public function create(Request $request): View
    {
        $flashMessage = null;
        $intendedUrl = Session::get('url')['intended'] ?? '';
        if (preg_match('~email/verify/(.*)/(.*)\?expires=(.*)&signature=(.*)~', $intendedUrl)) {
            $flashMessage = 'To confirm your email, please log in';
        }

        return view('auth.login', [
            'flashMessage' => $flashMessage,
            'pageTitle'    => 'Вход',
        ]);
    }

    public function store(UserLoginRequest $request): RedirectResponse
    {
        $credentials = [
            'email'    => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return to_route('base.landing');
    }
}

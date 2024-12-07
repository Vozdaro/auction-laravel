<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\AutenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::controller(RegisteredUserController::class)->group(function () {
    Route::name('auth.')->group(function () {
        Route::get('/auth', 'create')->name('create');
        Route::post('/auth', 'store')->name('store');
    });
});

Route::controller(AutenticatedSessionController::class)->group(function () {
    Route::name('auth.')->group(function () {
        Route::get('/login', 'create')->name('login');
//        Route::post('/auth', 'store')->name('store');
    });
});

Route::middleware(['auth:web'])->group(function () {
    Route::controller(EmailVerificationController::class)->group(function () {
        Route::prefix('email')->name('verification.')->group(function () {
            Route::get('/verify', 'notice')->name('notice');
            Route::get('/verify/{id}/{hash}', 'verify')->name('verify')
                ->middleware(['signed']);
            Route::post('/verification-notification', 'send')->name('send')
                ->middleware(['throttle:6,1']);
        });
    });
});

<?php

declare(strict_types=1);

use App\Http\Controllers\Api\Auth\AccessTokenApiController;
use App\Http\Controllers\Api\Auth\RegisteredUserApiController;
use App\Http\Controllers\Api\LotApiController;

Route::controller(RegisteredUserApiController::class)->group(function () {
    Route::prefix('register')->group(function () {
        Route::post('/', 'store');
    });
});

Route::controller(AccessTokenApiController::class)->group(function () {
    Route::prefix('login')->group(function () {
        Route::post('/', 'store');
    });
});

Route::controller(LotApiController::class)->group(function () {
    Route::prefix('lots')->group(function () {
        Route::get('/', 'index');
        Route::get('/{lotId}', 'view');
        Route::delete('/{lotId}', 'destroy')->middleware('auth:sanctum');
    });
});

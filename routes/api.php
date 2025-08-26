<?php

declare(strict_types=1);

use App\Http\Controllers\Api\Auth\RegisteredUserApiController;
use App\Http\Controllers\Api\LotApiController;

Route::controller(RegisteredUserApiController::class)->group(function () {
    Route::prefix('register')->group(function () {
        Route::post('/', 'store');
    });
});

Route::controller(LotApiController::class)->group(function () {
    Route::prefix('lots')->group(function () {
        Route::get('/{lotId}', 'view');
    });
});

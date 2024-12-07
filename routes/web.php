<?php

declare(strict_types=1);

use App\Http\Controllers\LandingController;
use Illuminate\Support\Facades\Route;

Route::controller(LandingController::class)->group(function () {
    Route::name('base.')->group(function () {
        Route::get('/', 'landing')->name('landing');
    });
});

require_once __DIR__ . '/auth.php';

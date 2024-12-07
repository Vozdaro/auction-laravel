<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class LandingController extends Controller
{
    public function landing(): View
    {
        return view('base.landing', [
            'pageTitle' => 'Главная',
        ]);
    }
}

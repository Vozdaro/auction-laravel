<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\Lot\Contracts\LotServiceInterface;
use Illuminate\View\View;

final class LandingController extends Controller
{
    public function __construct(
        public LotServiceInterface $lotService,
    ) {
    }

    public function __invoke(): View
    {
        return view('landing.index', [
            'pageTitle' => 'Главная',
            'lots'      => $this->lotService->getAll(),
        ]);
    }
}

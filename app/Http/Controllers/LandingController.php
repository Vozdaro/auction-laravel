<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\Category\Contracts\CategoryServiceInterface;
use App\Services\Lot\Contracts\LotServiceInterface;
use Illuminate\View\View;

final class LandingController extends AbstractController
{
    public function __construct(
        public CategoryServiceInterface $categoryService,
        public LotServiceInterface      $lotService,
    ) {
    }

    public function __invoke(): View
    {
        return view('landing.index', [
            'pageTitle'  => 'Главная',
            'lots'       => $this->lotService->getAll(),
            'categories' => $this->categoryService->getAll(),
        ]);
    }
}

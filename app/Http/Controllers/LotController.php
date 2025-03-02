<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\DTO\Lot\LotStoreDto;
use App\Http\Requests\Lot\LotStoreRequest;
use App\Models\Lot;
use App\Models\User;
use App\Services\Category\Contracts\CategoryServiceInterface;
use App\Services\Lot\Contracts\LotServiceInterface;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

final class LotController extends AbstractController
{
    public function __construct(
        protected LotServiceInterface $lotService,
        protected CategoryServiceInterface $categoryService,
    ) {
    }

    public function view(Lot $lot): View
    {
        return view('lot.view', [
            'pageTitle' => $lot->title,
            'lot'       => $lot
        ]);
    }

    public function create(): View
    {
        return view('lot.create', [
            'pageTitle'  => 'Добавить лот',
            'categories' => $this->categoryService->getAll(),
        ]);
    }

    public function store(LotStoreRequest $request): RedirectResponse
    {
        $lotStoreDto = LotStoreDto::fromRequest($request, $this->getUser($request));
        $this->lotService->store($lotStoreDto);

        return to_route('base.landing');
    }

}

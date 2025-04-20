<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\DTO\Lot\LotStoreDto;
use App\Exceptions\Lot\LotImageRequiredException;
use App\Http\Requests\Lot\LotStoreRequest;
use App\Models\Category;
use App\Models\Lot;
use App\Services\Category\Contracts\CategoryServiceInterface;
use App\Services\Lot\Contracts\LotServiceInterface;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

final class LotController extends AbstractController
{
    public function __construct(
        protected CategoryServiceInterface $categoryService,
        protected LotServiceInterface      $lotService,
    ) {
    }

    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $categoryId = intval($request->get('category'));

        return view('lot.index', [
            'pageTitle' => 'По категории',
            'lots'      => $this->lotService->getByCategoryId($categoryId),
            'category'  => Category::find($categoryId)
        ]);
    }

    /**
     * @param Lot $lot
     * @return View
     */
    public function view(Lot $lot): View
    {
        return view('lot.view', [
            'pageTitle' => $lot->title,
            'lot'       => $lot
        ]);
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('lot.create', [
            'pageTitle'  => 'Добавить лот',
            'categories' => $this->categoryService->getAll(),
        ]);
    }

    /**
     * @param LotStoreRequest $request
     * @return RedirectResponse
     * @throws LotImageRequiredException
     * @throws AuthenticationException
     */
    public function store(LotStoreRequest $request): RedirectResponse
    {
        $lotStoreDto = LotStoreDto::fromRequest($request, $this->getUser($request));
        $this->lotService->store($lotStoreDto);

        return to_route('base.landing');
    }
}

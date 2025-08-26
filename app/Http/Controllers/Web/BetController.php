<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web;

use App\DTO\Bet\BetStoreDto;
use App\Http\Controllers\AbstractController;
use App\Http\Requests\Bet\BetStoreRequest;
use App\Models\Lot;
use App\Services\Bet\Contracts\BetServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

final class BetController extends AbstractController
{
    /**
     * @param BetServiceInterface $betService
     */
    public function __construct(
        protected BetServiceInterface $betService,
    ) {
    }

    /**
     * @param Request $request
     * @return View
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function index(Request $request): View
    {
        return view('bet.index', [
            'pageTitle' => 'Мои ставки',
            'bets'      => $this->betService->getAllByUserId($this->getUser($request)->id),
        ]);
    }

    /**
     * @param BetStoreRequest $request
     * @return RedirectResponse
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function store(BetStoreRequest $request): RedirectResponse
    {
        Gate::authorize('store-bet', [Lot::find($request->lot_id)]);
        $betStoreDto = BetStoreDto::fromRequest($request);
        $bet = $this->betService->store($betStoreDto);

        return to_route('lot.view', $bet->lot->id);
    }

}

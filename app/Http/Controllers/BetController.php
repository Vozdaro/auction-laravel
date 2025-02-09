<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Dto\Bet\BetStoreDto;
use App\Http\Requests\Bet\BetStoreRequest;
use App\Models\Lot;
use App\Services\Bet\Contracts\BetServiceInterface;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

final class BetController extends Controller
{
    public function __construct(
        protected BetServiceInterface $betService,
    ) {
    }

    public function index(Authenticatable $user): View
    {
        return view('bet.index', [
            'pageTitle' => 'Мои ставки',
            'bets'      => $this->betService->getAllByUserId($user->id),
        ]);
    }

    public function store(BetStoreRequest $request): RedirectResponse
    {
        Gate::authorize('store-bet', [Lot::find($request->lot_id)]);
        $betStoreDto = BetStoreDto::fromRequest($request);
        $bet = $this->betService->store($betStoreDto);

        return to_route('lot.view', $bet->lot->id);
    }

}

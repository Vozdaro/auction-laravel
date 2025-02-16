<?php

declare(strict_types=1);

namespace App\Services\Bet;

use App\DTO\Bet\BetStoreDto;
use App\Models\Bet;
use App\Services\Bet\Contracts\BetServiceInterface;
use Illuminate\Database\Eloquent\Collection;

final class BetService implements BetServiceInterface
{
    public function store(BetStoreDto $betStoreDto): ?Bet
    {
        return Bet::create([
            'amount'  => $betStoreDto->amount,
            'lot_id'  => $betStoreDto->lot_id,
            'user_id' => $betStoreDto->user_id,
        ]);
    }

    public function getAllByUserId($user_id): Collection
    {
        return Bet::where(['user_id' => $user_id])->get();
    }
}

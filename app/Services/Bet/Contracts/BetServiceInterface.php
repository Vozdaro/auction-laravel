<?php

declare(strict_types=1);

namespace App\Services\Bet\Contracts;

use App\DTO\Bet\BetStoreDto;
use App\Models\Bet;
use Illuminate\Database\Eloquent\Collection;

interface BetServiceInterface
{
    /**
     * @param BetStoreDto $betStoreDto
     * @return Bet
     */
    public function store(BetStoreDto $betStoreDto): Bet;

    /**
     * @param $user_id
     * @return Collection
     */
    public function getAllByUserId($user_id): Collection;
}

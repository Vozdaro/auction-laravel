<?php

declare(strict_types=1);

namespace App\Services\Bet\Contracts;

use App\Dto\Bet\BetStoreDto;
use App\Models\Bet;
use Illuminate\Database\Eloquent\Collection;

interface BetServiceInterface
{
    public function store(BetStoreDto $betStoreDto): ?Bet;
    public function getAllByUserId($user_id): Collection;
}

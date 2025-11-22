<?php

declare(strict_types=1);

namespace App\Storages\Repositories\Bet\Contracts;

use App\DTO\Bet\BetStoreDto;
use App\Models\Bet;
use App\Storages\Contracts\ModelStorageInterface;

interface BetRepositoryInterface extends ModelStorageInterface
{

    /**
     * @param BetStoreDto $betStoreDto
     * @return Bet
     */
    public function createForConnection(BetStoreDto $betStoreDto): Bet;
}

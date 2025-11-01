<?php

declare(strict_types=1);

namespace App\Storages\Repositories\Bet\Contracts;

use App\DTO\Bet\BetStoreDto;
use App\Models\Bet;
use App\Storages\Contracts\ModelStorageInterface;
use Illuminate\Database\Eloquent\Collection;

interface BetRepositoryInterface extends ModelStorageInterface
{
    /**
     * @param $id
     * @return Collection
     */
    public function getAll($id): Collection;

    /**
     * @param BetStoreDto $betStoreDto
     * @return Bet
     */
    public function createForConnection(BetStoreDto $betStoreDto): Bet;
}

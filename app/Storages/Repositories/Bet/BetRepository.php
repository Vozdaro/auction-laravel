<?php

declare(strict_types=1);

namespace App\Storages\Repositories\Bet;

use App\DTO\Bet\BetStoreDto;
use App\Models\Bet;
use App\Storages\Repositories\AbstractRepository;
use App\Storages\Repositories\Bet\Contracts\BetRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class BetRepository extends AbstractRepository implements BetRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function destroy(int|array $ids): bool
    {
        return boolval(Bet::destroy($ids));
    }

    /**
     * @inheritdoc
     */
    public function getAll($id): Collection
    {
        return Bet::where(['user_id' => $id])->get();
    }

    /**
     * @inheritdoc
     */
    public function createForConnection(BetStoreDto $betStoreDto): Bet
    {
        return Bet::create([
            'amount'  => $betStoreDto->amount,
            'lot_id'  => $betStoreDto->lot_id,
            'user_id' => $betStoreDto->user_id,
        ]);
    }
}

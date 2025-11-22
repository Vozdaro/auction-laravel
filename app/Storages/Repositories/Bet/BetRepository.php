<?php

declare(strict_types=1);

namespace App\Storages\Repositories\Bet;

use App\DTO\Bet\BetStoreDto;
use App\Models\Bet;
use App\Storages\Repositories\AbstractRepository;
use App\Storages\Repositories\Bet\Contracts\BetRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

final class BetRepository extends AbstractRepository implements BetRepositoryInterface
{
    /**
     * @inheritdoc
     */
    protected static function modelName(): string
    {
        return Bet::class;
    }

    /**
     * @inheritdoc
     */
    public function getAll(array $params = []): Collection
    {
        return Bet::where($params['user_id'])->get();
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

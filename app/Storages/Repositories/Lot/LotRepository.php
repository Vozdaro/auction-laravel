<?php

namespace App\Storages\Repositories\Lot;

use App\Models\Lot;
use App\Storages\Repositories\Lot\Contracts\LotRepositoryInterface;

class LotRepository implements LotRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function destroy(int|array $ids): bool
    {
        return Lot::destroy($ids);
    }
}

<?php

declare(strict_types=1);

namespace App\Storages\Repositories\Lot;

use App\Models\Lot;
use App\Storages\Repositories\AbstractRepository;
use App\Storages\Repositories\Lot\Contracts\LotRepositoryInterface;

final class LotRepository extends AbstractRepository implements LotRepositoryInterface
{
    /**
     * @inheritdoc
     */
    protected static function modelName(): string
    {
        return Lot::class;
    }

    /**
     * @inheritdoc
     */
    public function get($id): Lot
    {
        return Lot::on($this->readConnection)->find($id);
    }
}

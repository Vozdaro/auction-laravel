<?php

declare(strict_types=1);

namespace App\Storages\Repositories\Lot\Contracts;

use App\Models\Lot;
use App\Storages\Contracts\ModelStorageInterface;

interface LotRepositoryInterface extends ModelStorageInterface
{
    /**
     * @param int|array $ids
     * @return bool
     */
    public function destroy(int|array $ids): bool;

    /**
     * @param $id
     * @return Lot
     */
    public function get($id): Lot;
}

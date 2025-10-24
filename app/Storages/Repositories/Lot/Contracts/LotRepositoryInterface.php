<?php

declare(strict_types=1);

namespace App\Storages\Repositories\Lot\Contracts;

use App\Models\Lot;
use App\Storages\Contracts\ModelStorageInterface;

interface LotRepositoryInterface extends ModelStorageInterface
{
    public function destroy(int|array $ids): bool;
    public function get($id): Lot;
}

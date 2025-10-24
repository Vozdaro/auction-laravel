<?php
declare(strict_types=1);

namespace App\Storages\Repositories\Lot;

use App\Models\Lot;
use App\Storages\Repositories\AbstractRepository;
use App\Storages\Repositories\Lot\Contracts\LotRepositoryInterface;

class LotRepository extends AbstractRepository implements LotRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function destroy(int|array $ids): bool
    {
        return boolval(Lot::destroy($ids));
    }

    public function get($id): Lot
    {
        return Lot::on($this->readConnection)->find($id);
    }
}

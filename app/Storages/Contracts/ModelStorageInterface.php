<?php

declare(strict_types=1);

namespace App\Storages\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface ModelStorageInterface
{
    /**
     * @param int|array $ids
     * @return bool
     */
    public function destroy(int|array $ids): bool;

    /**
     * @param array $params
     * @return Collection
     */
    public function getAll(array $params = []): Collection;
}

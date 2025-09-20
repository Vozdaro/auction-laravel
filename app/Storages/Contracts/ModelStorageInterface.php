<?php

declare(strict_types=1);

namespace App\Storages\Contracts;

interface ModelStorageInterface
{
    /**
     * @param int|array $ids
     * @return bool
     */
    public function destroy(int|array $ids): bool;
}

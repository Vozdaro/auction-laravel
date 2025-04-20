<?php

declare(strict_types=1);

namespace App\Services\Lot\Contracts;

use App\DTO\Lot\LotStoreDto;
use App\Models\Lot;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface LotServiceInterface
{
    /**
     * @param bool $paginate
     * @return Collection|LengthAwarePaginator
     */
    public function getAll(bool $paginate = false): Collection|LengthAwarePaginator;

    public function getByCategoryId(int $id): Collection;

    public function store(LotStoreDto $lotStoreDto): ?Lot;
}

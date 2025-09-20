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

    /**
     * @param int $id
     * @return Collection
     */
    public function getByCategoryId(int $id): Collection;

    /**
     * @param LotStoreDto $lotStoreDto
     * @return Lot|null
     */
    public function store(LotStoreDto $lotStoreDto): ?Lot;

    /**
     * @param $q
     * @return Collection
     */
    public function getLotBySearchQuery($q): Collection;

    /**
     * @param int $id
     * @return Lot|null
     */
    public function getOne(int $id): ?Lot;

    /**
     * @param int $lotId
     * @return bool
     */
    public function deleteOne(int $lotId): bool;
}

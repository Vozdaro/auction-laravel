<?php

declare(strict_types=1);

namespace App\Services\Lot\Contracts;

use App\Dto\Lot\LotStoreDto;
use App\Models\Lot;
use Illuminate\Database\Eloquent\Collection;

interface LotServiceInterface
{
    public function getAll(): Collection;
    public function store(LotStoreDto $lotStoreDto): ?Lot;
}

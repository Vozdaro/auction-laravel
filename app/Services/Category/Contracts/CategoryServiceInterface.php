<?php

declare(strict_types=1);

namespace App\Services\Category\Contracts;

use App\Dto\Category\CategoryStoreDto;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

interface CategoryServiceInterface
{
    public function getAll(): Collection;
    public function store(CategoryStoreDto $categoryStoreDto): ?Category;
}

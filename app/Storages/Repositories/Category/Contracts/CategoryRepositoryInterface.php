<?php

declare(strict_types = 1);

namespace App\Storages\Repositories\Category\Contracts;

use App\DTO\Category\CategoryStoreDto;
use App\Models\Category;
use App\Storages\Contracts\ModelStorageInterface;
use Illuminate\Database\Eloquent\Collection;

interface CategoryRepositoryInterface extends ModelStorageInterface
{
    /**
     * @param CategoryStoreDto $categoryStoreDto
     * @param $connectionPostfix
     * @return Category
     */
    public function store(CategoryStoreDto $categoryStoreDto, $connectionPostfix): Category;

    /**
     * @return Collection
     */
    public function getAll(): Collection;
}

<?php

declare(strict_types=1);

namespace App\Services\Category;

use App\DTO\Category\CategoryStoreDto;
use App\Enum\ReplicationPostfixEnum;
use App\Models\Category;
use App\Services\Category\Contracts\CategoryServiceInterface;
use App\Storages\Repositories\Category\Contracts\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

final class CategoryService implements CategoryServiceInterface
{
    public function __construct (
        private CategoryRepositoryInterface $categoryRepository
    ) {}

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->categoryRepository->getAll();
    }

    /**
     * @param CategoryStoreDto $categoryStoreDto
     * @return Category|null
     */
    public function store(CategoryStoreDto $categoryStoreDto): ?Category
    {
        $masterCategory = null;

        foreach (ReplicationPostfixEnum::toArray() as $connectionPostfix) {
            $category = $this->categoryRepository->store($categoryStoreDto, $connectionPostfix);

            if ($connectionPostfix === 'master') {
                $masterCategory = $category;
            }
        }

        return $masterCategory;
    }

}

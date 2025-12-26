<?php

declare(strict_types=1);

namespace App\Storages\Repositories\Category;

use App\DTO\Category\CategoryStoreDto;
use App\Models\Category;
use App\Storages\Repositories\AbstractRepository;
use App\Storages\Repositories\Category\Contracts\CategoryRepositoryInterface;

final class CategoryRepository extends AbstractRepository implements CategoryRepositoryInterface
{
    /**
     * @inheritDoc
     */
    protected static function modelName(): string
    {
        return Category::class;
    }

    /**
     * @inheritDoc
     */
    public function store(CategoryStoreDto $categoryStoreDto, $connectionPostfix): Category
    {
        return Category::on("mysql_$connectionPostfix")->create([
            'name'       => $categoryStoreDto->name,
            'inner_code' => $categoryStoreDto->innerCode,
        ]);
    }
}

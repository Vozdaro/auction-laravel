<?php

declare(strict_types=1);

namespace App\Storages\Repositories\Category;

use App\DTO\Category\CategoryStoreDto;
use App\Models\Bet;
use App\Models\Category;
use App\Storages\Repositories\AbstractRepository;
use App\Storages\Repositories\Category\Contracts\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository extends AbstractRepository implements CategoryRepositoryInterface
{
    /**
     * @inheritdoc
     */
    public function destroy(int|array $ids): bool
    {
        return boolval(Category::destroy($ids));
    }

    /**
     * @inheritdoc
     */
    public function getAll(): Collection
    {
        return Category::all();
    }

    /**
     * @inheritdoc
     */
    public function store(CategoryStoreDto $categoryStoreDto, $connectionPostfix): Category
    {
        return Category::on("mysql_$connectionPostfix")->create([
            'name' => $categoryStoreDto->name,
            'inner_code' => $categoryStoreDto->innerCode,
        ]);
    }
}

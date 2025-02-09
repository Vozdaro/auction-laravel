<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Dto\Category\CategoryStoreDto;
use App\Services\Category\Contracts\CategoryServiceInterface;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    private const CATEGORIES = [
        [
            'name'       => 'Доски и лыжи',
            'inner_code' => 'boards'
        ],
        [
            'name'       => 'Крепления',
            'inner_code' => 'attachment'
        ],
        [
            'name'       => 'Ботинки',
            'inner_code' => 'boots'
        ],
        [
            'name'       => 'Одежда',
            'inner_code' => 'clothing'
        ],
        [
            'name'       => 'Инструменты',
            'inner_code' => 'tools'
        ],
        [
            'name'       => 'Разное',
            'inner_code' => 'other'
        ],
    ];

    public function __construct(
        protected CategoryServiceInterface $categoryService,
    ) {
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (self::CATEGORIES as $category) {
            $categoryStoreDto = CategoryStoreDto::fromArray($category);
            $this->categoryService->store($categoryStoreDto);
        }
    }
}

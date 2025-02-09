<?php

declare(strict_types=1);

namespace App\Dto\Category;

final readonly class CategoryStoreDto
{
    public function __construct(
        public string $name,
        public string $innerCode,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new CategoryStoreDto(
            $data['name'],
            $data['inner_code']
        );
    }
}

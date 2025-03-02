<?php

declare(strict_types=1);

namespace App\DTO\Category;

use Exception;

final readonly class CategoryStoreDto
{
    /**
     * @param string $name
     * @param string $innerCode
     */
    public function __construct(
        public string $name,
        public string $innerCode,
    ) {
    }

    /**
     * @param array<string, string> $data
     * @return self
     * @throws Exception
     */
    public static function fromArray(array $data): self
    {
        return new self(
            $data['name'],
            $data['inner_code']
        );
    }
}

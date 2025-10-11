<?php

declare(strict_types=1);

namespace App\Enum\Trait;

trait ArrayableEnumTrait
{
    /**
     * @return list<string>
     */
    public static function toArray(): array
    {
        return array_map(
            fn ($case) => $case->value,
            self::cases()
        );
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Responses;

interface ModelResponseInterface
{
    /**
     * @return array<string, mixed>
     */
    public function toResponseArray(): array;
}

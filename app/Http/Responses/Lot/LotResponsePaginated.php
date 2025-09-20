<?php

declare(strict_types=1);

namespace App\Http\Responses\Lot;

use App\Http\Responses\AbstractResponse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;

final class LotResponsePaginated extends AbstractResponse
{
    public static function build(Model|LengthAwarePaginator|array $data, int $status): JsonResponse
    {
        if (!($data instanceof LengthAwarePaginator)) {
            self::checkModel($data);
        }

        return self::wrap(
            array_map(fn ($lot) => $lot->toResponseArray(), $data->items()),
            $status,
            $data
        );
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Responses\User;

use App\Http\Responses\AbstractResponse;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpFoundation\Response;

final class UserResponse extends AbstractResponse
{
    public static function build(Model|LengthAwarePaginator|array $data, int $status): JsonResponse
    {
        if ($data instanceof Model) {
            self::checkModel($data);
        }

        return self::wrap(
            $data->toResponseArray(),
            $status
        );
    }
}

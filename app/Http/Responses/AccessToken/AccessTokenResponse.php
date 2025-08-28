<?php

namespace App\Http\Responses\AccessToken;

use _PHPStan_ac6dae9b0\Nette\Neon\Exception;
use App\Http\Responses\AbstractResponse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;

class AccessTokenResponse extends AbstractResponse
{

    /**
     * @inheritDoc
     */
    public static function build(Model|LengthAwarePaginator|array $data, int $status): JsonResponse
    {
        if (!is_array($data)) {
            throw new Exception();
        }

        return self::wrap(
            $data ? [
                ...$data,
                'type' => 'Bearer',
            ] : [],
            $status
        );
    }
}

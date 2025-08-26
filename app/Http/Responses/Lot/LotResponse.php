<?php

declare(strict_types=1);

namespace App\Http\Responses\Lot;

use App\Models\Lot;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class LotResponse
{
    public static function build(Lot $lot): JsonResponse
    {
        return new JsonResponse(
            [
                'id'    => $lot->id,
                'title' => $lot->title,
            ],
            Response::HTTP_OK
        );
    }
}

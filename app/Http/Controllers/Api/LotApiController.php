<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AbstractController;
use App\Http\Responses\Lot\LotResponse;
use App\Services\Lot\Contracts\LotServiceInterface;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;

final class LotApiController extends AbstractController
{
    public function __construct(
        protected LotServiceInterface $lotService,
    ) {}

    #[OA\Get(path: '/api/v1/lots/{id}', summary: 'Get lot by ID.', tags: ['Lot'])]
    #[OA\Parameter(name: 'id', description: 'Lot ID', in: 'path', required: true)]
    #[OA\Response(response: Response::HTTP_OK, description: 'OK')]
    public function view(int $lotId): JsonResponse
    {
        $lot = $this->lotService->getOne($lotId);

        return LotResponse::build($lot);
    }
}

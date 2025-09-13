<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AbstractController;
use App\Http\Responses\Lot\LotResponse;
use App\Http\Responses\Lot\LotResponsePaginated;
use App\Services\Lot\Contracts\LotServiceInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;

final class LotApiController extends AbstractController
{
    public function __construct(
        protected LotServiceInterface $lotService,
    ) {}

    /**
     * @throws Exception
     */
    #[OA\Get(path: '/api/v1/lots/{id}', summary: 'Get lot by ID.', tags: ['Lot'])]
    #[OA\Parameter(name: 'id', description: 'Lot ID', in: 'path', required: true)]
    #[OA\Response(response: Response::HTTP_OK, description: 'OK')]
    public function view(int $lotId): JsonResponse
    {
        if (!$lot = $this->lotService->getOne($lotId)) {
            return new JsonResponse(
                ['message' => 'Lot not found'],
                Response::HTTP_NOT_FOUND
            );
        }

        return LotResponse::build($lot, Response::HTTP_OK);
    }

    /**
     * @throws Exception
     */
    #[OA\Get(path: '/api/v1/lots', summary: 'Get all lots.', tags: ['Lot'])]
    #[OA\Parameter(name: 'page', description: 'page', in: 'query', required: false)]
    #[OA\Response(response: Response::HTTP_OK, description: 'OK')]
    #[OA\Response(response: Response::HTTP_UNAUTHORIZED, description: 'Unauthenticated')]
    public function index(): JsonResponse
    {
        $lots = $this->lotService->getAll(true);

        return LotResponsePaginated::build($lots, Response::HTTP_OK);
    }
}

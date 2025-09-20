<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AbstractController;
use App\Http\Responses\Lot\LotResponse;
use App\Http\Responses\Lot\LotResponsePaginated;
use App\Models\Lot;
use App\Services\Lot\Contracts\LotServiceInterface;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;

final class LotApiController extends AbstractController
{
    public function __construct(
        protected LotServiceInterface $lotService,
    ) {
    }

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

    /**
     * @throws AuthenticationException
     */
    public function destroy(int $lotId, Request $request): JsonResponse
    {
        Gate::authorize('delete-lot', [$this->getUser($request)]);

        if (!Lot::find($lotId)) {
            return new JsonResponse(
                ['message' => "Lot with id=$lotId not found"],
                Response::HTTP_NOT_FOUND
            );
        }

        $lotDeleted = $this->lotService->deleteOne($lotId);
        $status = $lotDeleted ? Response::HTTP_NO_CONTENT : Response::HTTP_INTERNAL_SERVER_ERROR;

        return new JsonResponse(
            ['message' => 'Lot has been deleted'],
            $status
        );
    }
}

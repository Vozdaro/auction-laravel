<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Auth;

use App\DTO\User\UserStoreDto;
use App\Http\Controllers\AbstractController;
use App\Http\Requests\Auth\UserStoreRequest;
use App\Http\Responses\User\UserResponse;
use App\Services\User\Contracts\UserServiceInterface;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;

final class RegisteredUserApiController extends AbstractController
{
    public function __construct(
        protected UserServiceInterface $userService,
    ) {
    }

    #[OA\Post(path: '/api/v1/register', summary: 'Creates a new user.', tags: ['Auth'])]
    #[OA\RequestBody(required: true, content: new OA\MediaType(mediaType: 'application/json', schema: new OA\Schema(properties: [
        new OA\Property(property: 'email', type: 'string'),
        new OA\Property(property: 'passwordFlash', type: 'string'),
        new OA\Property(property: 'passwordFlash_confirmation', type: 'string'),
        new OA\Property(property: 'name', type: 'string'),
        new OA\Property(property: 'contact_info', type: 'string'),
    ])))]
    #[OA\Response(response: Response::HTTP_CREATED, description: 'Created')]
    #[OA\Response(response: Response::HTTP_UNPROCESSABLE_ENTITY, description: 'Unprocessable content')]
    #[OA\Response(response: Response::HTTP_INTERNAL_SERVER_ERROR, description: 'Internal server error')]
    public function store(UserStoreRequest $request): JsonResponse
    {
        $userStoreDto = UserStoreDto::fromRequest($request);
        $user = $this->userService->store($userStoreDto);

        return UserResponse::build($user, Response::HTTP_CREATED);
    }
}

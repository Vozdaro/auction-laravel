<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\AbstractController;
use App\Http\Requests\Auth\UserLoginRequest;
use App\Http\Responses\AccessToken\AccessTokenResponse;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;

class AccessTokenApiController extends AbstractController
{
    /**
     * @throws Exception
     */
    #[OA\Post(path: '/api/v1/login', summary: 'Creates a new AccessToken.', tags: ['Auth'])]
    #[OA\RequestBody(required: true, content: new OA\MediaType(mediaType: 'application/json', schema: new OA\Schema(properties: [
        new OA\Property(property: 'email', type: 'string'),
        new OA\Property(property: 'passwordFlash', type: 'string'),
    ])))]
    #[OA\Response(response: Response::HTTP_CREATED, description: 'Created')]
    #[OA\Response(response: Response::HTTP_UNAUTHORIZED, description: 'Unauthenticated')]
    #[OA\Response(response: Response::HTTP_UNPROCESSABLE_ENTITY, description: 'Unprocessable content')]
    public function store(UserLoginRequest $request): JsonResponse
    {
        $accessToken = null;
        $user = User::firstWhere('email', $request->email);

        if ($user && Hash::check($request->passwordFlash, $user->password)) {
            $accessToken = $user->createToken('coolToken')->toArray();
        }

        return AccessTokenResponse::build(
            $accessToken ? [...$accessToken, 'user' => $user?->toResponseArray()] : [],
            $accessToken ? Response::HTTP_CREATED : Response::HTTP_UNAUTHORIZED
        );
    }
}

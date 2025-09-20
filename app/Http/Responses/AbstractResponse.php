<?php

declare(strict_types=1);

namespace App\Http\Responses;

//use App\Http\Responses\AccessToken\AccessTokenResponse;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author Todd <anatolev.web@icloud.com>
 */
abstract class AbstractResponse
{
    public const string UNAUTHENTICATED_MESSAGE = 'Unauthenticated.1';

    /**
     * @param Model|LengthAwarePaginator<int, ModelResponseInterface>|array<string, mixed> $data
     * @param int                                                                          $status
     * @return JsonResponse
     * @throws Exception
     */
    abstract public static function build(Model|LengthAwarePaginator|array $data, int $status): JsonResponse;

    /**
     * @param array<string, mixed>|array<int, array<string, mixed>> $data
     * @param int $status
     * @param LengthAwarePaginator<int, ModelResponseInterface>|null $paginator
     * @return JsonResponse
     */
    protected static function wrap(array $data, int $status, ?LengthAwarePaginator $paginator = null): JsonResponse
    {
        //        if (get_called_class() === AccessTokenResponse::class && $status === Response::HTTP_UNAUTHORIZED) {
        //            $resp = ['message' => self::UNAUTHENTICATED_MESSAGE];
        //        } else {

        $resp = ['data' => $data];

        if (isset($paginator)) {
            $resp = [
                'current_page'  => $paginator->currentPage(),
                'data'          => $data,
                'links'         => $paginator->linkCollection(),
                'prev_page_url' => $paginator->previousPageUrl(),
                'next_page_url' => $paginator->nextPageUrl(),
                'total'         => $paginator->total(),
                'per_page'      => $paginator->perPage(),
            ];
        }
        //        }

        return new JsonResponse($resp, $status);
    }

    /**
     * @param Model $model
     * @return void
     * @throws Exception
     */
    protected static function checkModel(Model $model): void
    {
        $calledClass = get_called_class();
        $modelClass = 'App\Models\\' . (explode('\\', $calledClass)[3] ?? '');

        if (!($model instanceof $modelClass)) {
            throw new Exception(
                "Invalid model passed to $calledClass ::build",
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}

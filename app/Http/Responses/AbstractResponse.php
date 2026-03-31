<?php

declare(strict_types=1);

namespace App\Http\Responses;

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
    public const DATA_KEY = 'data';

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
        $resp = compact('data');

        if (isset($paginator)) {
            $resp = [
                'current_page'  => $paginator->currentPage(),
                self::DATA_KEY  => $data,
                'links'         => $paginator->linkCollection(),
                'prev_page_url' => $paginator->previousPageUrl(),
                'next_page_url' => $paginator->nextPageUrl(),
                'total'         => $paginator->total(),
                'per_page'      => $paginator->perPage(),
            ];
        }

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

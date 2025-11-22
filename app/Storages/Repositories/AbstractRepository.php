<?php

declare(strict_types=1);

namespace App\Storages\Repositories;

use App\Storages\Contracts\ModelStorageInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository implements ModelStorageInterface
{
    public string $readConnection;

    protected ?Model $model = null;

    public function __construct()
    {
        $modelClassname = static::modelName();
        $this->model = new $modelClassname();

        $this->readConnection = config('database.read_connection');
    }

    /**
     * @param int|array $ids
     * @return bool
     */
    public function destroy(int|array $ids): bool
    {
        return boolval(model::destroy($ids));
    }

    /**
     * @param array $params
     * @return Collection
     */
    public function getAll(array $params = []): Collection
    {
        return $this->model::all();
    }

    /**
     * @return string
     */
    abstract protected static function modelName(): string;
}

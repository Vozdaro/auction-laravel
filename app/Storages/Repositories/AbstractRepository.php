<?php

declare(strict_types=1);

namespace App\Storages\Repositories;

use App\Models\Lot;

class AbstractRepository
{
    public string $readConnection;

    public function __construct()
    {
        $this->readConnection = config('database.read_connection');
    }
}

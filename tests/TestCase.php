<?php

declare(strict_types=1);

namespace Tests;

use Database\Seeders\LotSeeder;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;

abstract class TestCase extends BaseTestCase
{
    public function prepareDatabase(): void
    {
        Artisan::call('db:wipe --database=pgsql_master');
        Artisan::call('db:wipe --database=pgsql_slave');
        Artisan::call('migrate:install --database=pgsql_master');
        Artisan::call('migrate:install --database=pgsql_slave');
        Artisan::call('migrate:fresh --database=pgsql_master');

        $this->assertDatabaseEmpty('users');
        $this->assertDatabaseEmpty('categories');
        $this->assertDatabaseEmpty('lots');

        $this->seed();

        $this->assertDatabaseCount('users', 2);
        $this->assertDatabaseCount('categories', 6);
        $this->assertDatabaseCount('lots', count(LotSeeder::LOTS));
    }
}

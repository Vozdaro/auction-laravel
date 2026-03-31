<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Enum\ReplicationPostfixEnum;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

final class MigrateFreshAllCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:fresh-all {dbms}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate fresh for all db-connections';

    /**
     * Execute the console command.
     *
     * php artisan migrate:fresh-all pgsql
     *
     * @throws Exception
     */
    public function handle(): void
    {
        $dbms = $this->argument('dbms');

        foreach (ReplicationPostfixEnum::toArray() as $connection) {
            $params = [
                '--database' => "{$dbms}_$connection"
            ];

            Artisan::call('db:wipe', $params);
            Artisan::call('migrate:install', $params);
        }

        Artisan::call('migrate', [
            '--seed' => true
        ]);
    }
}

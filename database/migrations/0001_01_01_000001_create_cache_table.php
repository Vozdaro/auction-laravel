<?php

use App\Enum\ReplicationPostfixEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        foreach (ReplicationPostfixEnum::toArray() as $connectionPostfix) {
            Schema::connection("mysql_$connectionPostfix")->create('cache', function (Blueprint $table) {
                $table->string('key')->primary();
                $table->mediumText('value');
                $table->integer('expiration');
            });

            Schema::connection("mysql_$connectionPostfix")->create('cache_locks', function (Blueprint $table) {
                $table->string('key')->primary();
                $table->string('owner');
                $table->integer('expiration');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        foreach (ReplicationPostfixEnum::toArray() as $connectionPostfix) {
            Schema::connection("mysql_$connectionPostfix")->dropIfExists('cache');
            Schema::connection("mysql_$connectionPostfix")->dropIfExists('cache_locks');
        }
    }
};

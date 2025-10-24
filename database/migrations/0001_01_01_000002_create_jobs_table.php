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
            Schema::connection("mysql_$connectionPostfix")->create('jobs', function (Blueprint $table) {
                $table->id();
                $table->string('queue')->index();
                $table->longText('payload');
                $table->unsignedTinyInteger('attempts');
                $table->unsignedInteger('reserved_at')->nullable();
                $table->unsignedInteger('available_at');
                $table->unsignedInteger('created_at');
            });

            Schema::connection("mysql_$connectionPostfix")->create('job_batches', function (Blueprint $table) {
                $table->string('id')->primary();
                $table->string('name');
                $table->integer('total_jobs');
                $table->integer('pending_jobs');
                $table->integer('failed_jobs');
                $table->longText('failed_job_ids');
                $table->mediumText('options')->nullable();
                $table->integer('cancelled_at')->nullable();
                $table->integer('created_at');
                $table->integer('finished_at')->nullable();
            });

            Schema::connection("mysql_$connectionPostfix")->create('failed_jobs', function (Blueprint $table) {
                $table->id();
                $table->timestamp('failed_at')->useCurrent();
                $table->string('uuid')->unique();
                $table->text('connection');
                $table->text('queue');
                $table->longText('payload');
                $table->longText('exception');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        foreach (ReplicationPostfixEnum::toArray() as $connectionPostfix) {
            Schema::connection("mysql_$connectionPostfix")->dropIfExists('jobs');
            Schema::connection("mysql_$connectionPostfix")->dropIfExists('job_batches');
            Schema::connection("mysql_$connectionPostfix")->dropIfExists('failed_jobs');
        }
    }
};

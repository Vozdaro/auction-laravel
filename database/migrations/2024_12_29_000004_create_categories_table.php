<?php

declare(strict_types=1);

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
            Schema::connection("mysql_$connectionPostfix")->create('categories', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
                $table->string('name')->unique();
                $table->string('inner_code')->unique();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        foreach (ReplicationPostfixEnum::toArray() as $connectionPostfix) {
            Schema::connection("mysql_$connectionPostfix")->dropIfExists('categories');
        }
    }
};

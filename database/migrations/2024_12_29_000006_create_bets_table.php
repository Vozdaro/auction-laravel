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
            Schema::connection("mysql_$connectionPostfix")->create('bets', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
                $table->integer('amount');
                $table->unsignedBigInteger('user_id');
                $table->unsignedBigInteger('lot_id');
                $table->boolean('is_win')->default(false);

                $table->foreign('user_id')->references('id')->on('users');
                $table->foreign('lot_id')->references('id')->on('lots');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        foreach (ReplicationPostfixEnum::toArray() as $connectionPostfix) {
            Schema::connection("mysql_$connectionPostfix")->dropIfExists('bets');
        }
    }
};

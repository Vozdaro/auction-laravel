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
            Schema::connection("mysql_$connectionPostfix")->create('personal_access_tokens', function (Blueprint $table) {
                $table->id();
                $table->morphs('tokenable');
                $table->text('name');
                $table->string('token', 64)->unique();
                $table->text('abilities')->nullable();
                $table->timestamp('last_used_at')->nullable();
                $table->timestamp('expires_at')->nullable()->index();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        foreach (ReplicationPostfixEnum::toArray() as $connectionPostfix) {
            Schema::connection("mysql_$connectionPostfix")->dropIfExists('personal_access_tokens');
        }
    }
};

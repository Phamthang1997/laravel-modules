<?php

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
        Schema::table('personal_access_tokens', function (Blueprint $table) {
            $table->string('token_type')->after('abilities')->default(null)->nullable();
            $table->bigInteger('access_id')->after('token_type')->default(null)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumns('personal_access_tokens', ['token_type', 'access_id'])) {
            Schema::table('personal_access_tokens', function (Blueprint $table) {
                $table->dropColumn('token_type');
                $table->dropColumn('access_id');
            });
        }
    }
};
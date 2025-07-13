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
        Schema::table('users', function (Blueprint $table) {
            $table->index(['is_active', 'created_at'], 'idx_active_latest');
            $table->index('is_expert', 'idx_is_expert');
            $table->index('is_job_seeker', 'idx_is_job_seeker');
            $table->index('gender', 'idx_gender');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};

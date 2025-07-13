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
        Schema::table('expert_infos', function (Blueprint $table) {
            $table->unique(['user_id', 'category', 'title'], 'expert_title_category_unique_key');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('expert_infos', function (Blueprint $table) {
            //
        });
    }
};

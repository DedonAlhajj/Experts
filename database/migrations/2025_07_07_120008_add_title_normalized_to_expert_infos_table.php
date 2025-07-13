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
            $table->string('title_normalized')->nullable()->index();
            $table->index(['category', 'title_normalized'], 'idx_category_title_normalized');
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

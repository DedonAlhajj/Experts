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
        // حذف الحقل القديم
        Schema::table('ads', function (Blueprint $table) {
            $table->dropColumn('position');
        });

        // إضافة الحقل الجديد
        Schema::table('ads', function (Blueprint $table) {
            $table->enum('position', ['header', 'sidebarLeft', 'sidebarRight', 'footer', 'inline'])->index()->after('description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ads', function (Blueprint $table) {
            $table->dropColumn('position');
        });

        Schema::table('ads', function (Blueprint $table) {
            $table->enum('position', ['header', 'sidebar', 'footer', 'inline'])->index()->after('description');
        });
    }

};

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
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->string('title')->index();                              // عنوان الإعلان
            $table->text('description')->nullable();                       // وصف نصي
            $table->enum('position', ['header', 'sidebar', 'footer', 'inline'])->index(); // مكان العرض
            $table->boolean('is_active')->default(true);                   // حالة التفعيل
            $table->dateTime('start_at')->nullable();                      // وقت بداية العرض
            $table->dateTime('end_at')->nullable();                        // وقت نهاية العرض
            $table->string('link')->nullable();                            // 🔗 رابط التحويل الخارجي
            $table->unsignedInteger('clicks')->default(0);                 // عدد النقرات
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ads');
    }
};

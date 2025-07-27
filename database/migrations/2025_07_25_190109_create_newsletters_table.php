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
        Schema::create('newsletters', function (Blueprint $table) {
            $table->id();
            $table->string('title');                      // عنوان النشرة
            $table->text('body');                         // محتوى الرسالة الكامل
            $table->string('cta_label')->nullable();      // نص زر الدعوة إلى إجراء (CTA)
            $table->string('cta_url')->nullable();        // رابط الزر
            $table->boolean('is_sent')->default(false);   // هل تم إرسالها؟
            $table->timestamp('send_at')->nullable();     // وقت الإرسال المجدول
            $table->timestamps();                         // created_at و updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('newsletters');
    }
};

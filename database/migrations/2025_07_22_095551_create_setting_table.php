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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            // 🔑 اسم الإعداد (مفتاح فريد مثل: site_logo)
            $table->string('key')->unique();

            // 💾 القيمة النصية أو رابط الصورة أو رقم أو Boolean
            $table->text('value')->nullable();

            // 🧬 نوع القيمة: text | boolean | number | image | json (اختياري)
            $table->string('type')->default('text');

            // 📝 وصف للإعداد (اختياري لتوليد واجهة ديناميكية)
            $table->string('description')->nullable();

            // ⚙️ هل الإعداد قابل للتعديل من لوحة التحكم؟
            $table->boolean('editable')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setting');
    }
};

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
        Schema::create('expert_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->enum('category', ['skill', 'certificate', 'portfolio', 'experience']);
            $table->string('title')->nullable();          // اسم المهارة أو الشهادة
//            $table->string('institution')->nullable();    // جهة العمل أو المؤسسة
//            $table->text('description')->nullable();
//            $table->string('attachment_url')->nullable(); // رابط لصورة أو ملف
//
//            $table->date('start_date')->nullable();
//            $table->date('end_date')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expert_infos');
    }
};

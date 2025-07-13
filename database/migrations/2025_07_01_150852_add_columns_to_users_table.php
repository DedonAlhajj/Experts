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
            $table->string('phone')->nullable()->after('email');
            $table->string('slug')->unique()->nullable()->after('phone');

            $table->boolean('is_expert')->default(false)->after('slug');
            $table->boolean('is_job_seeker')->default(false)->after('is_expert');

            $table->string('profile_image')->nullable()->after('is_job_seeker');
            $table->text('bio')->nullable()->after('profile_image');
            $table->string('cv_file')->nullable()->after('bio');

            $table->enum('gender', ['male', 'female', 'other'])->nullable()->after('cv_file');
            $table->date('date_of_birth')->nullable()->after('gender');

            $table->string('country')->nullable()->after('date_of_birth');
            $table->string('city')->nullable()->after('country');
            $table->string('nationality')->nullable()->after('city');
            $table->string('address')->nullable()->after('nationality');

            $table->json('social_links')->nullable()->after('address');

            $table->boolean('available_for_remote')->default(false)->after('social_links');
            $table->boolean('is_active')->default(false)->after('available_for_remote');
            $table->boolean('is_admin')->default(false)->after('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone',
                'slug',
                'is_expert',
                'is_job_seeker',
                'profile_image',
                'bio',
                'cv_file',
                'gender',
                'date_of_birth',
                'country',
                'city',
                'nationality',
                'address',
                'social_links',
                'available_for_remote',
                'is_active',
                'is_admin',
            ]);
        });
    }
};

//Schema::create('expert_infos', function (Blueprint $table) {
//    $table->id();
//
//    $table->unsignedBigInteger('expert_id'); // ربط بالخبير
//    $table->enum('category', ['skill', 'certificate', 'portfolio', 'experience']);
//    $table->string('title')->nullable();       // عنوان المهارة أو الشهادة أو المشروع
//    $table->string('institution')->nullable(); // جهة الإصدار أو جهة العمل
//    $table->text('description')->nullable();   // وصف عام
//    $table->string('attachment_url')->nullable(); // لرابط أو صورة
//
//    $table->date('start_date')->nullable();    // لتجربة عمل أو إصدار شهادة
//    $table->date('end_date')->nullable();      // لانتهاء التجربة أو مدة المشروع
//
//    $table->timestamps();
//
//    $table->foreign('expert_id')->references('id')->on('experts')->onDelete('cascade');
//});


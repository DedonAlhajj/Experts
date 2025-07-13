<?php

namespace Database\Seeders;

use App\Models\ExpertInfo;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExpertInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userId = User::first()?->id ?? 1; // أو اختاري user موجود

        $data = [
            [
                'user_id' => $userId,
                'category' => 'certificate',
                'title' => 'Laravel Certified Developer',
                'institution' => 'Laravel Certification Authority',
                'description' => 'شهادة احتراف في تطوير تطبيقات Laravel.',
                'attachment_url' => 'certificates/laravel.pdf',
                'start_date' => '2023-01-15',
                'end_date' => '2023-01-15',
            ],
            [
                'user_id' => $userId,
                'category' => 'skill',
                'title' => 'Bootstrap 5',
                'description' => 'مهارات تصميم واجهات متجاوبة وحديثة.',
                'start_date' => '2021-06-01',
                'end_date' => null,
            ],
            [
                'user_id' => $userId,
                'category' => 'portfolio',
                'title' => 'موقع خدمات طبية',
                'institution' => 'Freelance',
                'description' => 'موقع لحجز المواعيد وإدارة ملفات المرضى.',
                'attachment_url' => 'portfolios/clinic.png',
                'start_date' => '2022-03-01',
                'end_date' => '2022-05-30',
            ],
            [
                'user_id' => $userId,
                'category' => 'experience',
                'title' => 'Full-Stack Developer',
                'institution' => 'TechNova Solutions',
                'description' => 'تطوير تطبيقات باستخدام Laravel و Vue.',
                'start_date' => '2020-08-01',
                'end_date' => '2023-06-30',
            ],
        ];

        foreach ($data as $entry) {
            ExpertInfo::create($entry);
        }
    }
}

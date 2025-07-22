<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'key'         => 'site_logo',
                'value'       => 'logos/default-logo.png',
                'type'        => 'image',
                'description' => 'شعار الموقع في رأس الصفحة',
                'editable'    => true,
            ],
            [
                'key'         => 'site_title',
                'value'       => 'منصة الإعلانات الهندسية',
                'type'        => 'text',
                'description' => 'عنوان الموقع العام',
                'editable'    => true,
            ],
            [
                'key'         => 'maintenance_mode',
                'value'       => 'false',
                'type'        => 'boolean',
                'description' => 'تفعيل وضع الصيانة للموقع',
                'editable'    => false,
            ],
            [
                'key'         => 'default_language',
                'value'       => 'ar',
                'type'        => 'text',
                'description' => 'اللغة الافتراضية للواجهة',
                'editable'    => true,
            ],
            [
                'key'         => 'contact_email',
                'value'       => 'support@example.com',
                'type'        => 'email',
                'description' => 'البريد الإلكتروني للتواصل',
                'editable'    => true,
            ],
            [
                'key'         => 'ads_rotation_delay',
                'value'       => '5000',
                'type'        => 'number',
                'description' => 'مدة التبديل بين الإعلانات في السلايدر (ms)',
                'editable'    => true,
            ],
            [
                'key'         => 'github_url',
                'value'       => 'http://safap.org.sy/',
                'type'        => 'url',
                'description' => 'مدة التبديل بين الإعلانات في السلايدر (ms)',
                'editable'    => true,
            ],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                [
                    'value'       => $setting['value'],
                    'type'        => $setting['type'],
                    'description' => $setting['description'],
                    'editable'    => $setting['editable'],
                ]
            );
        }
    }
}

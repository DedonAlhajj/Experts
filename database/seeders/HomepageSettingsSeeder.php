<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HomepageSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [

            // 🔗 Navbar
            ['key' => 'home.nav.item_1', 'value' => 'Home'],
            ['key' => 'home.nav.item_2', 'value' => 'Specializations'],
            ['key' => 'home.nav.item_3', 'value' => 'Job Seekers'],
            ['key' => 'home.nav.item_4', 'value' => 'Experts'],
            ['key' => 'home.nav.item_5', 'value' => 'Blog'],
            ['key' => 'home.nav.item_6', 'value' => 'Contact'],

            // 🏠 Hero Section
            ['key' => 'home.hero.heading_1', 'value' => 'Find Job, Experts, and Career Opportunities'],
            ['key' => 'home.hero.heading_2', 'value' => 'The Easiest Way to Find Your New Expert'],
            ['key' => 'home.hero.label_1', 'value' => 'Members'],
            ['key' => 'home.hero.label_2', 'value' => 'Experts'],
            ['key' => 'home.hero.label_3', 'value' => 'Job Seekers'],

            // 📌 Section 2
            ['key' => 'home.section_2.title_1', 'value' => "Expert's specializations"],
            ['key' => 'home.section_2.title_2', 'value' => 'Top specializations'],

            // 📦 Section 3 - 4 Blocks
            ['key' => 'home.section_3.block_1.title', 'value' => 'Browse a Lot of Expert Profiles'],
            ['key' => 'home.section_3.block_1.text', 'value' => "Explore a rapidly growing network of professionals across diverse fields—whether they're seeking job opportunities, showcasing their expertise, or doing both."],

            ['key' => 'home.section_3.block_2.title', 'value' => 'Flexible Talent Connections'],
            ['key' => 'home.section_3.block_2.text', 'value' => "Discover top talent effortlessly, follow their latest updates, and connect over opportunities or services that align with your career goals or project needs."],

            ['key' => 'home.section_3.block_3.title', 'value' => 'Leading Career Tracks'],
            ['key' => 'home.section_3.block_3.text', 'value' => "Dive into the most in-demand specialties and explore the expertise of leaders in tech, design, business, and beyond."],

            ['key' => 'home.section_3.block_4.title', 'value' => 'Find Top-Tier Professionals'],
            ['key' => 'home.section_3.block_4.text', 'value' => "Easily locate experts with the right skills and proven experience using an intelligent, lightning-fast search system."],

            // 🆕 Section 4
            ['key' => 'home.section_4.heading_1', 'value' => 'Recently Added Experts'],
            ['key' => 'home.section_4.heading_2', 'value' => 'Newest Members to Join the Platform'],
            ['key' => 'home.section_4.heading_3', 'value' => 'Top Advertisements'],

            // ⭐ Section 5
            ['key' => 'home.section_5.title', 'value' => 'Featured Experts You May Want to Connect With'],

            // 🧩 Section 6
            ['key' => 'home.section_6.label', 'value' => 'Experts'],
            ['key' => 'home.section_6.description', 'value' => 'Recently Registered Experts with Valuable Experience'],

            // 👥 Section 7
            ['key' => 'home.section_7.title', 'value' => 'Our Job Seekers'],
            ['key' => 'home.section_7.description', 'value' => 'Talented Job Seekers Ready for New Opportunities'],

            // 📄 Section: Specializations Page (home.nav.item_2)
            ['key' => 'home.breadcrumb_1', 'value' => 'Home'],
            ['key' => 'home.page_2.breadcrumb_2', 'value' => 'Specializations'],
            ['key' => 'home.page_2.header_text_1', 'value' => 'Browse Specializations'],

            ['key' => 'home.page_2.subsection_1.text_1', 'value' => 'Browse specializations'],
            ['key' => 'home.page_2.subsection_1.text_2', 'value' => 'Advance Search'],

            // 📄 Section: Job Seekers Page (home.nav.item_3)
            ['key' => 'home.page_3.breadcrumb', 'value' => 'Job Seekers'],
            ['key' => 'home.page_3.header_text', 'value' => 'Browse Job Seekers'],

            // 📄 Section: Experts Page (home.nav.item_4)
            ['key' => 'home.page_4.breadcrumb', 'value' => 'Experts'],
            ['key' => 'home.page_4.header_text', 'value' => 'Browse Experts'],

            ['key' => 'footer_title', 'value' => 'Almounkez'],

            ['key' => 'form_title1', 'value' => 'Find a Specializations'],
            ['key' => 'form_title2', 'value' => 'Find a Experts'],


        ];

        foreach ($settings as $item) {
            Setting::updateOrCreate(
                ['key' => $item['key']],
                [
                    'value' => $item['value'],
                    'type' => 'text',
                    'description' => null,
                    'editable' => true,
                ]
            );
        }
    }

}

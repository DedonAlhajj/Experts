<?php

namespace Database\Seeders;

use App\Models\ExpertInfo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;


class ExpertInfo1Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//        $institutions = ['Google', 'Microsoft', 'Amazon', 'Apple', 'MIT', 'Stanford University', 'IBM Research', 'Freelance', 'UNDP', 'NASA'];
//        $titles = ['Software Engineer', 'Project Manager', 'Data Analyst', 'Graphic Designer', 'AI Researcher', 'Marketing Consultant', 'Cybersecurity Specialist', 'UI/UX Designer', 'Systems Architect', 'DevOps Engineer'];

        $titles = [
            'Human Resources Specialist',
            'Financial Advisor',
            'Primary School Teacher',
            'Logistics Coordinator',
            'Architectural Designer',
            'Healthcare Administrator',
            'Psychologist',
            'Legal Consultant',
            'Event Planner',
            'Pharmaceutical Sales Representative',
            'Chef de Cuisine',
            'Fashion Stylist',
            'Journalist',
            'Fitness Trainer',
            'Customer Experience Manager',
            'Airline Cabin Crew',
            'Museum Curator',
            'Tour Guide',
            'Real Estate Agent',
            'Interpreter & Translator',
        ];
        $institutions = [
            'World Health Organization (WHO)',
            'Red Cross',
            'Al Salam Private Hospital',
            'British Council',
            'Hilton Hotels & Resorts',
            'United Nations Development Programme (UNDP)',
            'Dar Al-Fikr International School',
            'Al-Azhar University',
            'Qatar Airways',
            'UNICEF',
            'BBC News',
            'Zara Fashion Group',
            'Al Kindi Law Firm',
            'Sky Travel Agency',
            'Aramex Logistics',
            'Sheraton Hotels',
            'World Bank',
            'Al Bayan Publishing House',
            'Fitness First',
            'Ministry of Culture and Tourism',
        ];


        foreach (range(1, 20) as $i) {
            $title = fake()->randomElement($titles);
            $institution = fake()->randomElement($institutions);

            // Dates
            $startDate = fake()->dateTimeBetween('-10 years', '-2 years');
            $endDate = fake()->boolean(70)
                ? fake()->dateTimeBetween($startDate, 'now')
                : null;

            $userId = User::inRandomOrder()->value('id');
            ExpertInfo::create([
                'user_id' => $userId, // عدّلي بحسب عدد المستخدمين عندك
                'category' => 'experience',
                'title' => $title,
                'title_normalized' => strtolower($title),
                'institution' => $institution,
                'description' => fake()->paragraph(3),
                'start_date' => $startDate,
                'end_date' => $endDate,
            ]);
        }
    }

}

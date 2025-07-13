<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genders = ['male', 'female', 'other'];
        $countries = ['Syria', 'Egypt', 'Germany', 'Turkey', 'Canada'];
        $faker = fake();

        for ($i = 1; $i <= 15; $i++) {
            $name = $faker->name;
            $email = $faker->unique()->safeEmail;

            User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make('password'), // كلمة مرور افتراضية
                'phone' => $faker->phoneNumber,
                'is_expert' => $i % 3 === 0,        // كل ثالث مستخدم خبير
                'is_job_seeker' => $i % 2 === 0,     // كل زوجي باحث عن عمل
                'bio' => $faker->sentence(12),
                'profile_image' => null,
                'cv_file' => null,
                'gender' => $genders[array_rand($genders)],
                'date_of_birth' => $faker->dateTimeBetween('-40 years', '-20 years')->format('Y-m-d'),
                'country' => $faker->randomElement($countries),
                'city' => $faker->city,
                'nationality' => $faker->country,
                'address' => $faker->address,
                'available_for_remote' => $faker->boolean(60),
                'is_active' => true,
                'is_admin' => $i === 1, // المستخدم الأول هو أدمن
            ]);
        }
    }
}

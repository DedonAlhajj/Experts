<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = User::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt('password'),


            'phone' => $this->faker->phoneNumber(),
            'slug' => $this->faker->unique()->slug(),

            'is_expert' => $this->faker->boolean(30), // 30% احتمال صحيح
            'is_job_seeker' => $this->faker->boolean(30),

            'profile_image' => null,
            'bio' => $this->faker->paragraph(),
            'cv_file' => null,

            'gender' => $this->faker->randomElement(['male', 'female', 'other']),
            'date_of_birth' => $this->faker->date(),

            'country' => $this->faker->country(),
            'city' => $this->faker->city(),
            'nationality' => $this->faker->country(),
            'address' => $this->faker->address(),

            'social_links' => json_encode([
                'linkedin' => $this->faker->url(),
                'twitter' => $this->faker->url(),
            ]),

            'available_for_remote' => $this->faker->boolean(50),
            'is_active' => $this->faker->boolean(90),
            'is_admin' => $this->faker->boolean(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return $this
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}

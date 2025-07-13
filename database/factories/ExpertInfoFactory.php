<?php

namespace Database\Factories;

use App\Models\ExpertInfo;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ExpertInfo>
 */
class ExpertInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = ExpertInfo::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(), // ينشئ مستخدم مرتبط تلقائيًا

            'category' => $this->faker->randomElement(['skill', 'certificate', 'portfolio', 'experience']),
            'title' => $this->faker->sentence(3),
            'institution' => $this->faker->company(),
            'description' => $this->faker->paragraph(),
            'attachment_url' => $this->faker->optional()->imageUrl(),

            'start_date' => $this->faker->optional()->date(),
            'end_date' => $this->faker->optional()->date(),
        ];
    }
}

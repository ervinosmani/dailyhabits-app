<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Habit>
 */
class HabitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->optional()->paragraph(),
            'frequency' => $this->faker->randomElement(['daily', 'weekly', 'monthly']),
            'start_date' => $this->faker->date(),
            'user_id' => User::factory(),   // krijon edhe user automatikisht
        ];
    }
}

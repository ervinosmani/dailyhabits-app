<?php

namespace Database\Seeders;

use App\Models\Habit;
use App\Models\HabitCompletion;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HabitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Krijon 3 perdorues
        User::factory()->count(3)->create()->each(function ($user) {
            // Per cdo perdorues, krijon 5 zakone
            Habit::factory()->count(5)->create([
                'user_id' => $user->id,
            ])->each(function ($habit) {
                // Per cdo zakon, krijon 3 data te perfundimeve
                HabitCompletion::factory()->count(3)->create([
                    'habit_id' => $habit->id,
                ]);
            });
        });
    }
}

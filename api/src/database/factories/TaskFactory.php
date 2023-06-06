<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(...$attribute): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'body' => $this->faker->paragraph(),
            'time_estimated' => rand(20, 60),
            'time_spent' => 0,
            'author_id' => $attribute['author_id'] ?? User::factory(),
        ];
    }
}

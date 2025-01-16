<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class IssueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'issuer_id' => fake()->randomNumber(),
            'classification' => fake()->text(255),
            'title' => fake()->text(255),
            'description' => fake()->paragraph(),
            'status' => fake()->text(255),
            'worker_id' => fake()->randomNumber(),
            'memo' => fake()->paragraph(),
        ];
    }
}

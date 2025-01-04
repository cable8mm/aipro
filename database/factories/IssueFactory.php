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
            'id' => fake()->numerify(),
            'issuer_id' => fake()->randomNumber(),
            'classification' => fake()->text(),
            'title' => fake()->text(),
            'description' => fake()->paragraph(),
            'status' => fake()->text(),
            'worker_id' => fake()->randomNumber(),
            'memo' => fake()->paragraph(),
            'created_at' => fake()->unixTime(),
            'updated_at' => fake()->unixTime(),
        ];
    }
}

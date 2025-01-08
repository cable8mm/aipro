<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PlayautoCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'depth1' => fake()->text(255),
            'depth2' => fake()->text(255),
            'depth3' => fake()->text(255),
            'depth4' => fake()->text(255),
            'is_active' => fake()->boolean(),
        ];
    }
}

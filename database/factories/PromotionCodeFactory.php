<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PromotionCodeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'author_id' => fake()->randomNumber(1) + 1,
            'master_code' => 'PM'.fake()->randomNumber(3, true),
            'memo' => fake()->text(190),
            'started_at' => fake()->dateTime(),
            'finished_at' => fake()->dateTime(),
        ];
    }
}

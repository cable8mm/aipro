<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class GoodManualWarehousingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'good_id' => fake()->randomNumber(1) + 1,
            'user_id' => fake()->randomNumber(1) + 1,
            'manual_add_inventory_count' => fake()->randomNumber(),
            'type' => fake()->randomElement(['미입력', '입고', '출고']),
            'memo' => fake()->paragraph(),
        ];
    }
}

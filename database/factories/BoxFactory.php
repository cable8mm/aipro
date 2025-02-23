<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BoxFactory extends Factory
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
            'name' => fake()->word(),
            'code' => fake()->numerify('BOX-###'),
            'size' => fake()->randomNumber(1) + 1,
            'delivery_price' => fake()->randomElement([3000, 35000, 4000, 45000, 5000, 7000, 10000]),
            'cost_price' => fake()->randomNumber(4),
            'memo' => fake()->text(10),
        ];
    }
}

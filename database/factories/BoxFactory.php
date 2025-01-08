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
            'name' => fake()->word(),
            'code' => fake()->numerify('BOX-###'),
            'size' => fake()->randomNumber(),
            'delivery_price' => fake()->randomNumber(5),
            'box_price' => fake()->randomNumber(4),
            'inventory' => fake()->randomNumber(),
            'memo' => fake()->text(10),
        ];
    }
}

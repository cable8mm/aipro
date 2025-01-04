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
            'id' => fake()->numerify(),
            'name' => fake()->text(),
            'code' => fake()->text(),
            'size' => fake()->randomNumber(),
            'delivery_price' => fake()->randomNumber(),
            'box_price' => fake()->randomNumber(),
            'inventory' => fake()->randomNumber(),
            'memo' => fake()->text(),
            'created' => fake()->dateTime(),
            'modified' => fake()->dateTime(),
        ];
    }
}

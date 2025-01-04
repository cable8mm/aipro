<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PriceCoefficientFactory extends Factory
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
            'center_class' => fake()->randomLetter(),
            'start_price' => fake()->randomNumber(),
            'end_price' => fake()->randomNumber(),
            'coefficient' => fake()->randomFloat(2, 0, 10000),
            'created' => fake()->dateTime(),
            'modified' => fake()->dateTime(),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Enums\CenterClass;
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
            'center_class' => fake()->randomElement(CenterClass::names()),
            'start_price' => fake()->randomNumber(2),
            'end_price' => fake()->randomNumber(5) + 1,
            'coefficient' => fake()->randomFloat(3, 0, 9),
        ];
    }
}

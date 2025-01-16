<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_sheet_invoice_id' => fake()->randomNumber(1) + 1,
            'type' => fake()->randomElement(['피킹존 A', '피킹존 B', '피킹존 C']),
            'order_good_count' => fake()->randomNumber(),
            'printed_count' => fake()->randomNumber(),
        ];
    }
}

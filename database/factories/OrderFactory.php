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
            'id' => '100'.str_pad(fake()->randomNumber(9), 9, '0', STR_PAD_LEFT),
            'order_sheet_waybill_id' => fake()->randomNumber(1) + 1,
            'order_good_count' => fake()->numberBetween(1, 99),
            'waybill_numbers' => fake()->randomNumber(9, true).fake()->randomNumber(3, true),
            'printed_count' => fake()->numberBetween(0, 9),
        ];
    }
}

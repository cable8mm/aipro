<?php

namespace Database\Factories;

use App\Enums\OrderType;
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
            'order_sheet_invoice_id' => fake()->randomNumber(1) + 1,
            'type' => fake()->randomElements(OrderType::names(), fake()->randomNumber(2) % count(OrderType::cases())),
            'order_good_count' => fake()->numberBetween(1, 99),
            'printed_count' => fake()->numberBetween(0, 9),
            'is_all_good_matched' => fake()->boolean(),
        ];
    }
}

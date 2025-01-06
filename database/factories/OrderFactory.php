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
            'order_sheet_invoice_id' => fake()->randomNumber(),
            'type' => fake()->text(50),
            'is_all_good_matched' => fake()->boolean(),
            'has_center_class_j' => fake()->boolean(),
            'order_good_count' => fake()->randomNumber(),
            'printed_count' => fake()->randomNumber(),
            'created_at' => fake()->unixTime(),
            'updated_at' => fake()->unixTime(),
        ];
    }
}

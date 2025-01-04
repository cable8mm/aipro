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
            'id' => fake()->numerify(),
            'order_sheet_invoice_id' => fake()->randomNumber(),
            'type' => fake()->text(),
            'is_all_good_matched' => fake()->boolean(),
            'has_center_class_j' => fake()->boolean(),
            'order_good_count' => fake()->randomNumber(),
            'printed_count' => fake()->randomNumber(),
            'created' => fake()->dateTime(),
        ];
    }
}

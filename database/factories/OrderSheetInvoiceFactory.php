<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class OrderSheetInvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cms_maestro_id' => fake()->randomNumber(),
            'name' => fake()->text(255),
            'excel_filepath' => fake()->text(255),
            'order_row_count' => fake()->randomNumber(),
            'order_number_count' => fake()->randomNumber(),
            'order_good_count' => fake()->randomNumber(),
            'mismatched_order_good_count' => fake()->randomNumber(),
            'invoice_filepath' => fake()->text(255),
            'excel_json' => fake()->paragraph(),
            'status' => fake()->text(50),
            'created_at' => fake()->unixTime(),
            'updated_at' => fake()->unixTime(),
        ];
    }
}

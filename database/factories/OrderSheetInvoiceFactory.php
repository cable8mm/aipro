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
            'id' => fake()->numerify(),
            'cms_maestro_id' => fake()->randomNumber(),
            'name' => fake()->text(),
            'excel_filepath' => fake()->text(),
            'order_row_count' => fake()->randomNumber(),
            'order_number_count' => fake()->randomNumber(),
            'order_good_count' => fake()->randomNumber(),
            'mismatched_order_good_count' => fake()->randomNumber(),
            'invoice_filepath' => fake()->text(),
            'excel_json' => fake()->paragraph(),
            'status' => fake()->text(),
            'created_at' => fake()->unixTime(),
            'updated_at' => fake()->unixTime(),
        ];
    }
}

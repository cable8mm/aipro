<?php

namespace Database\Factories;

use App\Enums\Status;
use Database\Seeders\UserSeeder;
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
            'author_id' => fake()->numberBetween(0, UserSeeder::COUNT),
            'excel_filepath' => fake()->word().'.xlsx',
            'order_row_count' => fake()->randomNumber(2) + 1,
            'order_number_count' => fake()->randomNumber(2) + 1,
            'order_good_count' => fake()->randomNumber(2) + 1,
            'invoice_filepath' => fake()->word().'.xls',
            'excel_json' => fake()->words(10),
            'status' => fake()->randomElement(Status::names()),
        ];
    }
}

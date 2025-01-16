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
            'user_id' => fake()->numberBetween(0, UserSeeder::COUNT),
            'name' => fake('ko_KR')->sentence(),
            'excel_filepath' => fake()->word().'.xlsx',
            'order_row_count' => fake()->randomNumber(),
            'order_number_count' => fake()->randomNumber(),
            'order_good_count' => fake()->randomNumber(),
            'invoice_filepath' => fake()->word().'.'.fake()->fileExtension(),
            'excel_json' => fake()->words(10),
            'status' => fake()->randomElement(Status::names()),
        ];
    }
}

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
        $order_sheet_file = fake()->word().'.xlsx';
        $invoice_file = fake()->word().'.pdf';

        return [
            'author_id' => fake()->numberBetween(1, UserSeeder::COUNT),
            'order_sheet_file' => 'upload/order_sheets/'.$order_sheet_file,
            'order_sheet_file_name' => $order_sheet_file,
            'order_sheet_file_size' => fake()->randomNumber(8, true),
            'order_row_count' => fake()->randomNumber(2),
            'order_number_count' => fake()->randomNumber(2),
            'order_good_count' => fake()->randomNumber(2),
            'invoice_file' => 'upload/invoices/'.$invoice_file,
            'invoice_file_name' => $invoice_file,
            'invoice_file_size' => fake()->randomNumber(8, true),
            'excel_json' => fake()->words(10),
            'status' => fake()->randomElement(Status::names()),
        ];
    }
}

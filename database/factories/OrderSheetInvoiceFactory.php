<?php

namespace Database\Factories;

use App\Enums\OrderSheetInvoiceStatus;
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
            'author_id' => fake()->numberBetween(1, UserSeeder::COUNT),
            'order_sheet_file' => 'invoices/order_sheet_invoice.xls',
            'order_sheet_file_name' => 'order_sheet_invoice.xls',
            'order_sheet_file_size' => fake()->randomNumber(8, true),
            'invoice_file' => 'invoices/order_sheet_invoice.pdf',
            'invoice_file_name' => 'order_sheet_invoice.pdf',
            'invoice_file_size' => fake()->randomNumber(8, true),
            'excel_json' => fake()->words(10),
            'status' => OrderSheetInvoiceStatus::FILE_UPLOADED->name,
        ];
    }
}

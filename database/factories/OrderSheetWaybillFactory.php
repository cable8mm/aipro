<?php

namespace Database\Factories;

use App\Enums\OrderSheetWaybillStatus;
use Database\Seeders\UserSeeder;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class OrderSheetWaybillFactory extends Factory
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
            'order_sheet_file' => 'waybills/order_sheet_waybill_simple.xlsx',
            'order_sheet_file_name' => 'order_sheet_waybill.xls',
            'order_sheet_file_size' => fake()->randomNumber(8, true),
            'waybill_file' => 'waybills/order_sheet_waybill.pdf',
            'waybill_file_name' => 'order_sheet_waybill.pdf',
            'waybill_file_size' => fake()->randomNumber(8, true),
            'excel_json' => fake()->words(10),
            'status' => OrderSheetWaybillStatus::FILE_UPLOADED,
        ];
    }
}

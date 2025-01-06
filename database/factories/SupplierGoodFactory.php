<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SupplierGoodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ct_supplier_id' => fake()->randomNumber(),
            'good_code' => fake()->text(100),
            'center_code' => fake()->text(100),
            'supplier_attribute' => fake()->text(50),
            'supplier_category' => fake()->text(100),
            'godo_name' => fake()->text(191),
            'gn' => fake()->text(191),
            'name' => fake()->text(191),
            'origin' => fake()->text(100),
            'maker' => fake()->text(100),
            'brand' => fake()->text(100),
            'box_count' => fake()->randomNumber(),
            'quantity_in_box' => fake()->randomNumber(),
            'min_order_count' => fake()->text(191),
            'current_barcode' => fake()->text(191),
            'barcode' => fake()->text(100),
            'box_barcode' => fake()->text(50),
            'spec' => fake()->text(191),
            'inventory' => fake()->randomNumber(),
            'description' => fake()->paragraph(),
            'price' => fake()->randomNumber(),
            'suggested_selling_price' => fake()->randomNumber(),
            'suggestioned_retail_price' => fake()->randomNumber(),
            'supplier_monitoring_price' => fake()->randomNumber(),
            'ead' => fake()->date(),
            'additional_information' => fake()->paragraph(),
            'is_information_manual_sync' => fake()->boolean(),
            'is_runout' => fake()->boolean(),
            'is_warehoused' => fake()->boolean(),
            'is_shutdowned' => fake()->boolean(),
            'supplier_created' => fake()->date(),
            'supplier_modified' => fake()->date(),
            'created_at' => fake()->unixTime(),
            'updated_at' => fake()->unixTime(),
        ];
    }
}

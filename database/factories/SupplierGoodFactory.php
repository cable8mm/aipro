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
            'id' => fake()->numerify(),
            'ct_supplier_id' => fake()->randomNumber(),
            'good_code' => fake()->text(),
            'center_code' => fake()->text(),
            'supplier_attribute' => fake()->text(),
            'supplier_category' => fake()->text(),
            'godo_name' => fake()->text(),
            'gn' => fake()->text(),
            'name' => fake()->text(),
            'origin' => fake()->text(),
            'maker' => fake()->text(),
            'brand' => fake()->text(),
            'box_count' => fake()->randomNumber(),
            'quantity_in_box' => fake()->randomNumber(),
            'min_order_count' => fake()->text(),
            'current_barcode' => fake()->text(),
            'barcode' => fake()->text(),
            'box_barcode' => fake()->text(),
            'spec' => fake()->text(),
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

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
        fake()->addProvider(new \Bezhanov\Faker\Provider\Commerce(fake()));
        fake()->addProvider(new \Bezhanov\Faker\Provider\Device(fake()));

        return [
            'supplier_id' => fake()->randomNumber(1) + 1,
            'good_code' => fake()->numerify('GOOD-###'),
            'supplier_category' => fake()->randomElement(['꽃게|암컷', '꽃게|숫컷']),
            'name' => fake()->productName(),
            'origin' => fake('ko_KR')->country(),
            'maker' => fake()->company(),
            'brand' => fake()->deviceManufacturer(),
            'box_count' => fake()->randomNumber(1),
            'quantity_in_box' => fake()->randomNumber(1),
            'min_order_count' => fake()->randomNumber(1),
            'barcode' => fake()->ean13(),
            'spec' => fake()->text(10),
            'inventory' => fake()->randomNumber(2),
            'description' => fake()->paragraph(),
            'price' => fake()->randomNumber(4),
            'suggested_selling_price' => fake()->randomNumber(4),
            'suggestioned_retail_price' => fake()->randomNumber(4),
            'supplier_monitoring_price' => fake()->randomNumber(4),
            'additional_information' => fake()->paragraph(),
            'is_runout' => fake()->boolean(),
            'is_warehoused' => fake()->boolean(),
            'is_shutdowned' => fake()->boolean(),
        ];
    }
}

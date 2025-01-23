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
            'origin' => fake('ko_KR')->countryCode(),
            'maker' => fake()->company(),
            'brand' => fake()->deviceManufacturer(),
            'box_count' => fake()->randomNumber(1),
            'quantity_in_box' => fake()->randomNumber(1),
            'min_order_count' => fake()->randomNumber(1),
            'barcode' => fake()->ean13(),
            'spec' => fake()->randomElement(['', '500g', '1kg', '2kg', '3kg', '5kg']),
            'inventory' => fake()->randomNumber(2),
            'description' => '상세설명입니다.',
            'price' => fake()->randomNumber(4, true),
            'suggested_selling_price' => fake()->randomNumber(4, true),
            'suggested_retail_price' => fake()->randomNumber(4, true),
            'supplier_monitoring_price' => fake()->randomNumber(4, true),
            'additional_information' => '',
            'is_runout' => fake()->boolean(),
            'is_warehoused' => fake()->boolean(),
            'is_shutdown' => fake()->boolean(),
        ];
    }
}

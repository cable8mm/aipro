<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SupplierGoodsBakFactory extends Factory
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
            'code' => fake()->text(),
            'name' => fake()->text(),
            'previous_name' => fake()->text(),
            'box_count' => fake()->randomNumber(),
            'cost_price_without_vat' => fake()->randomNumber(),
            'cost_price_with_vat' => fake()->randomNumber(),
            'suggest_good_price' => fake()->randomNumber(),
            'customer_good_price' => fake()->randomNumber(),
            'additional_information' => fake()->text(),
            'created' => fake()->dateTime(),
            'modified' => fake()->dateTime(),
        ];
    }
}

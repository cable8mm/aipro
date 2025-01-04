<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PlacingOrderGoodFactory extends Factory
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
            'ct_order_id' => fake()->randomNumber(),
            'cms_maestro_id' => fake()->randomNumber(),
            'ct_good_id' => fake()->randomNumber(),
            'warehouse_manager_id' => fake()->randomNumber(),
            'order_count' => fake()->randomNumber(),
            'order_price' => fake()->randomNumber(),
            'supplier_confirmed_count' => fake()->randomNumber(),
            'supplier_confirmed_price' => fake()->randomNumber(),
            'cost_count' => fake()->randomNumber(),
            'cost_promotion_count' => fake()->randomNumber(),
            'cost_price' => fake()->randomNumber(),
            'is_promotion' => fake()->boolean(),
            'warehoused' => fake()->dateTime(),
            'status' => fake()->text(),
            'memo' => fake()->paragraph(),
            'ordered' => fake()->dateTime(),
            'created_at' => fake()->unixTime(),
            'updated_at' => fake()->unixTime(),
        ];
    }
}

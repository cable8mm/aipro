<?php

namespace Database\Factories;

use App\Enums\PlacingOrderGoodStatus;
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
            'placing_order_id' => fake()->randomNumber(1) + 1,
            'author_id' => fake()->randomNumber(1) + 1,
            'good_id' => fake()->randomNumber(1) + 1,
            'warehouse_manager_id' => fake()->randomNumber(1) + 1,
            'order_count' => fake()->randomNumber(2),
            'order_price' => fake()->randomNumber(5),
            'supplier_confirmed_count' => fake()->randomNumber(),
            'supplier_confirmed_price' => fake()->randomNumber(),
            'cost_count' => fake()->randomNumber(2),
            'cost_promotion_count' => fake()->randomNumber(),
            'cost_price' => fake()->randomNumber(5),
            'is_promotion' => fake()->boolean(),
            'warehoused_at' => fake()->dateTime(),
            'placing_ordered_at' => fake()->dateTime(),
            'status' => fake()->randomElement(PlacingOrderGoodStatus::names()),
            'memo' => fake()->paragraph(),
        ];
    }
}

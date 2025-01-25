<?php

namespace Database\Factories;

use App\Enums\PlacingOrder;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PlacingOrderBoxFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'box_placing_order_id' => fake()->randomNumber(1) + 1,
            'author_id' => fake()->randomNumber(1) + 1,
            'box_supplier_id' => fake()->randomNumber(1) + 1,
            'box_id' => fake()->randomNumber(1) + 1,
            'warehouse_manager_id' => fake()->randomNumber(1) + 1,
            'order_count' => fake()->randomNumber(2),
            'order_price' => fake()->randomNumber(5),
            'cost_count' => fake()->randomNumber(1),
            'cost_price' => fake()->randomNumber(5),
            'warehoused_at' => fake()->dateTime(),
            'status' => fake()->randomElement(PlacingOrder::names()),
            'memo' => fake()->paragraph(),
        ];
    }
}

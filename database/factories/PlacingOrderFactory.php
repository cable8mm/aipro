<?php

namespace Database\Factories;

use App\Enums\PlacingOrder;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PlacingOrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => (fake()->randomNumber(1) + 1),
            'warehouse_manager_id' => (fake()->randomNumber(1) + 1),
            'supplier_id' => (fake()->randomNumber(1) + 1),
            'title' => fake()->text(50),
            'ordered_at' => fake()->dateTime(),
            'total_good_count' => fake()->randomNumber() % 100,
            'total_order_price' => fake()->randomNumber(5),
            'order_discount_percent' => fake()->randomNumber(2),
            'sent_at' => fake()->dateTime(),
            'confirmed_at' => fake()->dateTime(),
            'predict_warehoused_at' => fake()->date(),
            'warehoused_at' => fake()->dateTime(),
            'status' => fake()->randomElement(PlacingOrder::names()),
            'memo' => fake()->paragraph(),
        ];
    }
}

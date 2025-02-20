<?php

namespace Database\Factories;

use App\Enums\PurchaseOrder;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PurchaseOrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'author_id' => fake()->numberBetween(1, 10),
            'warehouse_manager_id' => fake()->numberBetween(1, 10),
            'supplier_id' => fake()->numberBetween(1, 10),
            'title' => date('Y년 m월 n일').' 발주합니다.',
            'ordered_at' => fake()->dateTime(),
            'total_good_count' => fake()->randomNumber() % 100,
            'total_order_price' => fake()->randomNumber(5),
            'order_discount_percent' => fake()->randomNumber(2),
            'sent_at' => fake()->dateTime(),
            'confirmed_at' => fake()->dateTime(),
            'predict_warehoused_at' => fake()->date(),
            'warehoused_at' => fake()->dateTime(),
            'status' => fake()->randomElement(PurchaseOrder::names()),
            'memo' => fake()->paragraph(),
        ];
    }
}

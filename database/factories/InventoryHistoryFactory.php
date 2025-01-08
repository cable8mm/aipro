<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class InventoryHistoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->randomNumber(1) + 1,
            'good_id' => fake()->randomNumber(1) + 1,
            'type' => fake()->randomElement(['입고', '입고취소', '출고', '출고취소', '취소']),
            'quantity' => (fake()->boolean() ? 1 : -1) * (fake()->randomNumber(2) + 1),
            'price' => fake()->randomNumber(),
            'after_quantity' => fake()->randomNumber(),
            'model' => fake()->randomElement(['GoodManualWarehousing', 'Order', 'OrderGood', 'PlacingOrderGood', 'OrderShipment']),
            'attribute' => fake()->randomNumber(3),
            'cancel_id' => fake()->randomNumber(2),
            'is_success' => fake()->boolean(),
        ];
    }
}

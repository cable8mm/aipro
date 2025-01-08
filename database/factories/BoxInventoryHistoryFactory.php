<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BoxInventoryHistoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'box_id' => fake()->randomNumber(1) + 1,
            'type' => fake()->randomElement(['입고', '입고취소', '출고', '출고취소', '취소']),
            'quantity' => (fake()->boolean() ? 1 : -1) * fake()->randomNumber(1),
            'model' => fake()->randomElement(['GoodManualWarehousing', 'Order', 'OrderGood', 'PlacingOrderGood', 'OrderShipment']),
            'attribute' => fake()->randomNumber(3),
            'is_success' => fake()->boolean(),
            'created_at' => fake()->unixTime(),
            'updated_at' => fake()->unixTime(),
        ];
    }
}

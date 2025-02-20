<?php

namespace Database\Factories;

use App\Enums\InventoryHistory;
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
            'author_id' => fake()->randomNumber(1) + 1,
            'box_id' => fake()->randomNumber(1) + 1,
            'type' => fake()->randomElement(InventoryHistory::names()),
            'quantity' => (fake()->boolean() ? 1 : -1) * fake()->randomNumber(1),
            'model' => fake()->randomElement(['App\Models\BoxPurchaseOrders']),
            'attribute' => fake()->randomNumber(1) + 1,
            'is_success' => fake()->boolean(),
        ];
    }
}

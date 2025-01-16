<?php

namespace Database\Factories;

use App\Enums\InventoryHistory;
use App\Enums\InventoryHistoryModel;
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
            'type' => fake()->randomElement(InventoryHistory::array()),
            'quantity' => (fake()->boolean() ? 1 : -1) * (fake()->randomNumber(2) + 1),
            'price' => fake()->randomNumber(),
            'after_quantity' => fake()->randomNumber(),
            'model' => fake()->randomElement(InventoryHistoryModel::array()),
            'attribute' => fake()->randomNumber(3),
            'cancel_id' => fake()->randomNumber(2),
            'is_success' => fake()->boolean(),
        ];
    }
}

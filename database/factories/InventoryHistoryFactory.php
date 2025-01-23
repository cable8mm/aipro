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
            'author_id' => fake()->randomNumber(1) + 1,
            'good_id' => fake()->randomNumber(1) + 1,
            'type' => fake()->randomElement(InventoryHistory::names()),
            'quantity' => (fake()->boolean() ? 1 : -1) * (fake()->randomNumber(2) + 1),
            'price' => fake()->numberBetween(5000, 50000),
            'after_quantity' => fake()->randomNumber(2) + 1,
            'model' => fake()->randomElement(InventoryHistoryModel::names()),
            'attribute' => fake()->randomNumber(1) + 1,
            'cancel_id' => fake()->randomNumber(1) + 1,
            'is_success' => fake()->boolean(),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Enums\PurchaseOrderStatus;
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
            'purchase_ordered_at' => fake()->date(),
            'predict_warehoused_at' => fake()->date(),
            'warehoused_at' => fake()->dateTime(),
            'status' => fake()->randomElement(PurchaseOrderStatus::names()),
            'memo' => fake()->paragraph(),
        ];
    }
}

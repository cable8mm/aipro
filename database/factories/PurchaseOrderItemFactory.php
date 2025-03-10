<?php

namespace Database\Factories;

use App\Enums\PurchaseOrderItemStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PurchaseOrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $quantity = fake()->randomNumber(2);
        $unit_price = fake()->randomNumber(4);

        return [
            'purchase_order_id' => fake()->randomNumber(1) + 1,
            'author_id' => fake()->randomNumber(1) + 1,
            'item_id' => fake()->randomNumber(1) + 1,
            'quantity' => $quantity,
            'subtotal' => $quantity * $unit_price,
            'unit_price' => $unit_price,
            'warehoused_at' => fake()->dateTime(),
            'purchase_ordered_at' => fake()->dateTime(),
            'status' => fake()->randomElement(PurchaseOrderItemStatus::keys()),
            'memo' => fake()->paragraph(),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SupplierItemManualWarehousingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'supplier_item_id' => fake()->randomNumber(1) + 1,
            'author_id' => fake()->randomNumber(1) + 1,
            'manual_add_inventory_count' => (fake()->boolean() ? 1 : -1) * fake()->randomNumber(2),
            'memo' => fake()->randomElement(['', '긴급 할인 행사로 구매 후 입고', '품절 상품 재입고', '바코드 미기입 상품 입고']),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Enums\ManualInventoryAdjustmentType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class GoodManualWarehousingFactory extends Factory
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
            'good_id' => fake()->numberBetween(1, 10),
            'manual_add_inventory_count' => (fake()->boolean() === true ? 1 : -1) * fake()->randomNumber(2),
            'type' => fake()->randomElement(ManualInventoryAdjustmentType::names()),
            'memo' => fake()->randomElement(['', '고객 반품', '불량품 반품', '월말 재고 체크 중 발견']),
        ];
    }
}

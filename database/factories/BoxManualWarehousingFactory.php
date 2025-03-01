<?php

namespace Database\Factories;

use App\Enums\ManualInventoryAdjustmentType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BoxManualWarehousingFactory extends Factory
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
            'author_id' => fake()->randomNumber(1) + 1,
            'type' => fake()->randomElement(ManualInventoryAdjustmentType::names()),
            'amount' => (fake()->boolean() ? 1 : -1) * (fake()->randomNumber(1) + 1),
            'memo' => fake()->randomElement(['', '고객 반품', '불량품 반품', '월말 재고 체크 중 발견']),
        ];
    }
}

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
            'user_id' => fake()->randomNumber(1) + 1,
            'type' => fake()->randomElement(ManualInventoryAdjustmentType::array()),
            'manual_add_inventory_count' => (fake()->boolean() ? 1 : -1) * (fake()->randomNumber(1) + 1),
            'memo' => fake('ko_KR')->sentence(),
        ];
    }
}

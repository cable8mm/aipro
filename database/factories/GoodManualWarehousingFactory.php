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
            'good_id' => fake()->randomNumber(1) + 1,
            'user_id' => fake()->randomNumber(1) + 1,
            'manual_add_inventory_count' => (fake()->boolean() === true ? 1 : -1) * fake()->randomNumber(2),
            'type' => fake()->randomElement(ManualInventoryAdjustmentType::array()),
            'memo' => fake()->sentence(),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Enums\ItemInventoryLevel;
use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ItemInventorySnapshotFactory extends Factory
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
            'item_id' => fake()->randomNumber(1) + 1,
            'playauto_sku' => 'PM'.fake()->randomNumber(3, true),
            'inventory' => fake()->randomNumber(2) + 1,
            'inventory_level' => fake()->randomElement(ItemInventoryLevel::names()),
            'type' => fake()->randomElement(Status::names()),
        ];
    }
}

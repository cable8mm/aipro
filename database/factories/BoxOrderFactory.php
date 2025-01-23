<?php

namespace Database\Factories;

use App\Enums\PlacingOrder;
use Database\Seeders\UserSeeder;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BoxOrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'author_id' => fake()->numberBetween(0, UserSeeder::COUNT),
            'warehouse_manager_id' => fake()->numberBetween(0, UserSeeder::COUNT),
            'box_supplier_id' => fake()->numberBetween(0, UserSeeder::COUNT),
            'title' => fake()->text(30),
            'ordered_at' => fake()->dateTime(),
            'total_box_count' => fake()->randomNumber(2),
            'total_order_price' => fake()->randomNumber(5),
            'sent_at' => fake()->dateTime(),
            'confirmed_at' => fake()->dateTime(),
            'predict_warehoused_at' => fake()->dateTime(),
            'warehoused_at' => fake()->dateTime(),
            'status' => fake()->randomElement(PlacingOrder::names()),
            'memo' => fake()->paragraph(),
        ];
    }
}

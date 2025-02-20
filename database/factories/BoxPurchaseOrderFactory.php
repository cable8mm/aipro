<?php

namespace Database\Factories;

use App\Enums\PurchaseOrder;
use Database\Seeders\UserSeeder;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BoxPurchaseOrderFactory extends Factory
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
            'title' => date('Y년 m월 n일').' 박스 발주합니다.',
            'ordered_at' => fake()->dateTime(),
            'total_box_count' => fake()->randomNumber(2),
            'total_order_price' => fake()->randomNumber(5),
            'sent_at' => fake()->dateTime(),
            'confirmed_at' => fake()->dateTime(),
            'predict_warehoused_at' => fake()->dateTime(),
            'warehoused_at' => fake()->dateTime(),
            'status' => fake()->randomElement(PurchaseOrder::names()),
            'memo' => fake()->paragraph(),
        ];
    }
}

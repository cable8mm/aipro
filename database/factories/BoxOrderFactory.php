<?php

namespace Database\Factories;

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
            'id' => fake()->numerify(),
            'cms_maestro_id' => fake()->randomNumber(),
            'warehouse_manager_id' => fake()->randomNumber(),
            'ct_box_supplier_id' => fake()->randomNumber(),
            'title' => fake()->text(),
            'order_date' => fake()->date(),
            'total_box_count' => fake()->randomNumber(),
            'total_order_price' => fake()->randomNumber(),
            'sent' => fake()->dateTime(),
            'confirmed' => fake()->dateTime(),
            'predict_warehoused' => fake()->dateTime(),
            'warehoused' => fake()->dateTime(),
            'status' => fake()->text(),
            'memo' => fake()->paragraph(),
            'created' => fake()->dateTime(),
            'modified' => fake()->dateTime(),
        ];
    }
}

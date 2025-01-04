<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class InventoryHistoryFactory extends Factory
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
            'ct_good_id' => fake()->randomNumber(),
            'type' => fake()->text(),
            'quantity' => fake()->randomNumber(),
            'price' => fake()->randomNumber(),
            'after_quantity' => fake()->randomNumber(),
            'model' => fake()->text(),
            'attribute' => fake()->randomNumber(),
            'cancel_id' => fake()->randomNumber(),
            'is_success' => fake()->boolean(),
            'created' => fake()->dateTime(),
            'updated' => fake()->dateTime(),
        ];
    }
}

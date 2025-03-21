<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BoxFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $costPrice = fake()->randomNumber(4);

        return [
            'author_id' => fake()->randomNumber(1) + 1,
            'location_id' => fake()->numberBetween(1, 3),
            'box_supplier_id' => fake()->randomNumber(1) + 1,
            'name' => fake()->word(),
            'sku' => fake()->numerify('BOX-###'),
            'size' => fake()->randomNumber(1) + 1,
            'delivery_price' => fake()->randomElement([3000, 35000, 4000, 45000, 5000, 7000, 10000]),
            'cost_price' => $costPrice,
            'last_cost_price' => $costPrice * (1 + (fake()->randomNumber(2) / 100)),
            'memo' => fake()->text(10),
        ];
    }
}

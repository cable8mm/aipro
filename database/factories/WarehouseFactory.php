<?php

namespace Database\Factories;

use Cable8mm\GoodCode\LocationCode;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Warehouse>
 */
class WarehouseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => LocationCode::of(warehouse: fake()->uuid()),
            'description' => fake()->sentence(),
        ];
    }
}

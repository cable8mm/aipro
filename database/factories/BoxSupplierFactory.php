<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BoxSupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->text(255),
            'ordered_email' => fake()->text(255),
            'contact_name' => fake()->text(255),
            'contact_tel' => fake()->text(255),
            'contact_cel' => fake()->text(255),
            'order_method' => fake()->numberBetween(0, 127),
            'balance_criteria' => fake()->text(255),
            'min_order_price' => fake()->randomNumber(),
            'is_parceled' => fake()->boolean(),
            'additional_information' => fake()->paragraph(),
            'created_at' => fake()->unixTime(),
            'updated_at' => fake()->unixTime(),
        ];
    }
}

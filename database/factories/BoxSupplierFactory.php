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
            'id' => fake()->numerify(),
            'name' => fake()->text(),
            'ordered_email' => fake()->text(),
            'contact_name' => fake()->text(),
            'contact_tel' => fake()->text(),
            'contact_cel' => fake()->text(),
            'order_method' => fake()->numberBetween(0, 127),
            'balance_criteria' => fake()->text(),
            'min_order_price' => fake()->randomNumber(),
            'is_parceled' => fake()->boolean(),
            'additional_information' => fake()->paragraph(),
            'created' => fake()->dateTime(),
            'modified' => fake()->dateTime(),
        ];
    }
}

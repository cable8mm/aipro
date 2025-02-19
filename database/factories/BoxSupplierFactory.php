<?php

namespace Database\Factories;

use App\Enums\OrderMethod;
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
            'author_id' => fake()->randomNumber(1) + 1,  // Assuming User has an id column
            'name' => fake()->company(),
            'ordered_email' => fake()->email(),
            'contact_name' => fake()->name(),
            'contact_tel' => fake()->localAreaPhoneNumber(),
            'contact_cel' => fake()->cellPhoneNumber(),
            'order_method' => fake()->randomElement(OrderMethod::names()),
            'min_order_price' => fake()->randomElement([0, 100000, 200000, 500000, 1000000, 2000000]),
            'is_parceled' => fake()->boolean(),
            'additional_information' => fake()->paragraph(),
        ];
    }
}

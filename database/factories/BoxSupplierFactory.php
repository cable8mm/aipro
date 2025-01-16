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
            'name' => fake('ko_KR')->company(),
            'ordered_email' => fake()->email(),
            'contact_name' => fake('ko_KR')->name(),
            'contact_tel' => fake('ko_KR')->localAreaPhoneNumber(),
            'contact_cel' => fake('ko_KR')->cellPhoneNumber(),
            'order_method' => fake()->randomElement(OrderMethod::names()),
            'min_order_price' => fake()->randomElement([0, 100000, 200000, 500000, 1000000, 2000000]),
            'additional_information' => fake('ko_KR')->paragraph(),
        ];
    }
}

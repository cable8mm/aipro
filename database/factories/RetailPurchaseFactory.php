<?php

namespace Database\Factories;

use App\Enums\PaymentMethod;
use App\Enums\RetailPurchaseStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RetailPurchase>
 */
class RetailPurchaseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cashier_id' => fake()->randomNumber(1) + 1,
            'customer_id' => fake()->randomNumber(1) + 1,
            'payment_method' => fake()->randomElement(PaymentMethod::names()),
            'status' => fake()->randomElement(RetailPurchaseStatus::names()),
            'discount' => fake()->randomNumber(2, true) + 1,
            'notes' => fake()->sentence(),
            'purchased_at' => fake()->dateTimeThisYear(),
            'created_at' => fake()->dateTimeThisYear(),
            'updated_at' => fake()->dateTimeThisYear(),
        ];
    }
}

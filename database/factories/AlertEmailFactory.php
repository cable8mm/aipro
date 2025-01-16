<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AlertEmailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $email_list = [];

        for ($i = 0; $i < fake()->randomNumber(1); $i++) {
            $email_list[] = fake()->email();
        }

        return [
            'email_list' => $email_list,
        ];
    }
}

<?php

namespace Database\Factories;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class RegisterOptionGoodRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'requester_id' => fake()->randomNumber(1) + 1,
            'worker_id' => fake()->randomNumber(1) + 1,
            'title' => fake()->sentence(),
            'request_file_url' => fake()->url(),
            'status' => fake()->randomElement(Status::toKeys()),
            'respond_file_url' => fake()->url(190),
            'memo' => fake()->paragraph(),
        ];
    }
}

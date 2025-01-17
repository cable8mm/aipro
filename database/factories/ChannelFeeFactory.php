<?php

namespace Database\Factories;

use App\Enums\Site;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ChannelFeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'channel' => fake()->randomElement(Site::names()),
            'fee_rate' => fake()->randomFloat(2, 0, 4),
        ];
    }
}

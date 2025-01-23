<?php

namespace Database\Factories;

use App\Enums\Channel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ChannelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'author_id' => fake()->randomNumber(1) + 1,
            'name' => fake('ko_KR')->name(),
            'playauto_site' => fake()->text(190),
            'siteid' => fake()->text(100),
            'fee_rate' => fake()->randomFloat(2, 0, 999),
            'total_good_count' => fake()->randomNumber(),
            'total_sale_good_count' => fake()->randomNumber(),
            'total_sold_out_good_count' => fake()->randomNumber(),
            'total_no_sale_good_count' => fake()->randomNumber(),
            'filepath' => fake()->text(190),
            'last_processed_at' => fake()->dateTime(),
            'memo' => fake()->paragraph(),
            'is_active' => fake()->boolean(),
            'status' => fake()->randomElement(Channel::names()),
        ];
    }
}

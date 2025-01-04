<?php

namespace Database\Factories;

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
            'id' => fake()->numerify(),
            'last_process_maestro_id' => fake()->randomNumber(),
            'name' => fake()->text(),
            'playauto_site' => fake()->text(),
            'siteid' => fake()->text(),
            'fee_rate' => fake()->randomFloat(2, 0, 10000),
            'total_good_count' => fake()->randomNumber(),
            'total_sale_good_count' => fake()->randomNumber(),
            'total_sold_out_good_count' => fake()->randomNumber(),
            'total_no_sale_good_count' => fake()->randomNumber(),
            'filepath' => fake()->text(),
            'last_processed' => fake()->dateTime(),
            'memo' => fake()->paragraph(),
            'is_active' => fake()->boolean(),
            'status' => fake()->text(),
            'created_at' => fake()->unixTime(),
            'updated_at' => fake()->unixTime(),
        ];
    }
}

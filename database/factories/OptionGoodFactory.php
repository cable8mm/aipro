<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class OptionGoodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cms_maestro_id' => fake()->randomNumber(),
            'playauto_master_code' => fake()->text(130),
            'godo_code' => fake()->text(255),
            'name' => fake()->text(130),
            'option_count' => fake()->randomNumber(),
            'my_shop_sale_option_count' => fake()->randomNumber(),
            'other_shop_sale_option_count' => fake()->randomNumber(),
            'is_active' => fake()->boolean(),
            'created_at' => fake()->unixTime(),
            'updated_at' => fake()->unixTime(),
        ];
    }
}

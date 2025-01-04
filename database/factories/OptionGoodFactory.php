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
            'id' => fake()->numerify(),
            'cms_maestro_id' => fake()->randomNumber(),
            'playauto_master_code' => fake()->text(),
            'godo_code' => fake()->text(),
            'name' => fake()->text(),
            'option_count' => fake()->randomNumber(),
            'my_shop_sale_option_count' => fake()->randomNumber(),
            'other_shop_sale_option_count' => fake()->randomNumber(),
            'is_active' => fake()->boolean(),
            'created' => fake()->dateTime(),
            'modified' => fake()->dateTime(),
        ];
    }
}

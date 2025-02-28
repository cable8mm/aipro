<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class GoodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        fake()->addProvider(new \Bezhanov\Faker\Provider\Commerce(fake()));
        fake()->addProvider(new \Bezhanov\Faker\Provider\Device(fake()));

        $productName = fake()->productName();

        return [
            'author_id' => fake()->randomNumber(1) + 1,
            'item_id' => fake()->randomNumber(1) + 1,
            'list_image' => 'placeholder_list_image.png',
            'name' => $productName,
            'option' => fake()->randomElement([null, 'Large', 'Small', 'Medium']),
            'goods_price' => fake()->randomNumber(5),
            'memo' => fake()->paragraph(),
            'zero_margin_price' => fake()->randomNumber(),
        ];
    }
}

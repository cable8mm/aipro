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
            'playauto_category_id' => fake()->randomElement([10020400, 10030200, 10060600, 10061000]),
            'name' => $productName,
            'option' => fake()->randomElement([null, 'Large', 'Small', 'Medium']),
            'goods_price' => fake()->randomNumber(5),
            'memo' => fake()->paragraph(),
            'naver_category' => '5'.fake()->randomNumber(7),
            'naver_productid' => fake()->randomNumber(9),
            'naver_lowest_price_wrong' => fake()->boolean(),
            'naver_lowest_price' => fake()->randomNumber(),
            'internet_lowest_price' => fake()->randomNumber(),
            'zero_margin_price' => fake()->randomNumber(),
        ];
    }
}

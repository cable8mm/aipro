<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ChannelGoodFactory extends Factory
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
            'playauto_master_code' => fake()->text(),
            'goods_bar' => fake()->text(),
            'coupang_price' => fake()->randomNumber(),
            'coupang_sale_status' => fake()->text(),
            'coupang_approved' => fake()->text(),
            'coupang_inventory' => fake()->randomNumber(),
            'kakaotalk_price' => fake()->randomNumber(),
            'kakaotalk_sale_status' => fake()->text(),
            'kakaotalk_inventory' => fake()->randomNumber(),
            'ssg_price' => fake()->randomNumber(),
            'ssg_sale_status' => fake()->text(),
            'ssg_inventory' => fake()->randomNumber(),
            '11st_price' => fake()->randomNumber(),
            '11st_sale_status' => fake()->text(),
            '11st_inventory' => fake()->randomNumber(),
            'gmarket_price' => fake()->randomNumber(),
            'gmarket_sale_status' => fake()->text(),
            'gmarket_inventory' => fake()->randomNumber(),
            'storefarm_channel' => fake()->text(),
            'storefarm_price' => fake()->randomNumber(),
            'storefarm_sale_status' => fake()->text(),
            'storefarm_inventory' => fake()->randomNumber(),
            'auction_price' => fake()->randomNumber(),
            'auction_sale_status' => fake()->text(),
            'auction_inventory' => fake()->randomNumber(),
            'wemake_price' => fake()->randomNumber(),
            'wemake_sale_status' => fake()->text(),
            'gift_price' => fake()->randomNumber(),
            'gift_sale_status' => fake()->text(),
            'gift_inventory' => fake()->randomNumber(),
        ];
    }
}

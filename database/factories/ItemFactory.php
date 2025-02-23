<?php

namespace Database\Factories;

use App\Enums\CenterClass;
use App\Enums\ItemColor;
use App\Enums\SafeClass;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ItemFactory extends Factory
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
            'location_id' => fake()->numberBetween(1, 3),
            'supplier_id' => fake()->randomNumber(1) + 1,
            'supplier_item_id' => fake()->randomNumber(1) + 1,
            'box_id' => fake()->randomNumber(1) + 1,
            'name' => $productName,
            'supplier_out_of_stock_count' => fake()->randomNumber(),
            'safe_inventory' => fake()->randomNumber(1),
            'safe_class' => fake()->randomElement(SafeClass::names()),
            'center_class' => fake()->randomElement(CenterClass::names()),
            'category' => fake()->randomElement(['꽃게|암컷', '꽃게|숫컷']),
            'maker' => fake()->company(),
            'brand' => fake()->deviceManufacturer(),
            'cost_price' => fake()->randomNumber(5),
            'last_cost_price' => fake()->randomNumber(5),
            'suggested_selling_price' => fake()->randomNumber(5),
            'suggested_retail_price' => fake()->randomNumber(5),
            'spec' => fake()->randomElement(['5g*10p', '15mm']),
            'order_rule' => fake()->randomElement(['12', '24']),
            'barcode' => fake()->ean13(),
            'item_division_color' => fake()->randomElement(ItemColor::names()),
            'ship_quantity' => fake()->randomElement([1, 2, 4, 8, 16]),
            'memo' => fake()->paragraph(),
            'print_classification' => fake()->text(190),
            'is_supplier_out_of_stock' => fake()->boolean(),
            'can_be_shipped' => fake()->boolean(),
            'is_shutdown' => fake()->boolean(),
        ];
    }
}

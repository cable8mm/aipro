<?php

namespace Database\Factories;

use App\Enums\ItemInventoryLevel;
use App\Enums\ItemStatus;
use App\Enums\SupplierPricingPolicy;
use Cable8mm\GoodCode\LocationCode;
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
        $costPrice = fake()->randomNumber(5, true);
        $status = fake()->randomElement(ItemStatus::keys());

        return [
            'author_id' => fake()->randomNumber(1) + 1,
            'location_id' => LocationCode::of(warehouse: 'A'.fake()->numberBetween(1, 3)),
            'supplier_id' => fake()->randomNumber(1) + 1,
            'supplier_item_id' => fake()->randomNumber(1) + 1,
            'box_id' => fake()->randomNumber(1) + 1,
            'name' => $productName,
            'supplier_out_of_stock_count' => fake()->randomNumber(),
            'safe_inventory' => fake()->randomNumber(1),
            'inventory_level' => fake()->randomElement(ItemInventoryLevel::keys()),
            'category' => fake()->randomElement(['꽃게|암컷', '꽃게|숫컷']),
            'maker' => fake()->company(),
            'brand' => fake()->deviceManufacturer(),
            'cost_price' => $costPrice,
            'last_cost_price' => $costPrice * (1 + (fake()->randomNumber(2) / 100)),
            'supplier_pricing_policy' => fake()->randomElement(SupplierPricingPolicy::keys()),
            'min_price' => $minPrice = fake()->randomNumber(5),
            'max_price' => $minPrice + fake()->randomNumber(4, true),
            'terminate_on_pricing_violation' => fake()->boolean(),
            'spec' => fake()->randomElement(['5g*10p', '15mm']),
            'order_rule' => fake()->randomElement(['12', '24']),
            'barcode' => fake()->ean13(),
            'ship_quantity' => fake()->randomElement([1, 2, 4, 8, 16]),
            'memo' => fake()->paragraph(),
            'print_classification' => fake()->text(190),
            'is_supplier_out_of_stock' => fake()->boolean(),
            'status' => $status,
            'discontinued_at' => $status === ItemStatus::DISCONTINUED->value ? now() : null,
        ];
    }
}

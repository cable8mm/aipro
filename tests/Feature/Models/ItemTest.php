<?php

namespace Tests\Feature\Models;

use App\Models\Item;
use Database\Seeders\BoxSeeder;
use Database\Seeders\BoxSupplierSeeder;
use Database\Seeders\ItemSeeder;
use Database\Seeders\LocationSeeder;
use Database\Seeders\SettingSeeder;
use Database\Seeders\SupplierItemSeeder;
use Database\Seeders\SupplierSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\WarehouseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ItemTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_plusminus_method(): void
    {
        $this->seed([
            UserSeeder::class,
            WarehouseSeeder::class,
            LocationSeeder::class,
            SupplierSeeder::class,
            SupplierItemSeeder::class,
            BoxSupplierSeeder::class,
            BoxSeeder::class,
            SettingSeeder::class,
            ItemSeeder::class,
        ]);

        $item = Item::orderBy('id', 'desc')->first();

        $old = $item->replicate();

        $item->plusminus(100, Item::class, $item->id);

        $new = $item;

        $this->assertSame($old->inventory + 100, $new->inventory);
    }

    public function test_calculate_zero_margin_price_method(): void
    {
        $item = new Item;

        $item->last_cost_price = 10000;

        $this->assertSame(11518, $item->calculateZeroMarginPrice());

        $item->last_cost_price = 100000;

        $this->assertSame(107500, $item->calculateZeroMarginPrice());
    }

    public function test_calculate_suggested_selling_price_method(): void
    {
        $this->seed([
            SettingSeeder::class,
        ]);

        $item = new Item;

        $item->zero_margin_price = 10000;

        $this->assertSame(13000, $item->calculateSuggestedSellingPrice());
    }
}

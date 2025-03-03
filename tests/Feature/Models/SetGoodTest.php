<?php

namespace Tests\Feature\Models;

use App\Models\Good;
use App\Models\SetGood;
use Database\Seeders\BoxSeeder;
use Database\Seeders\BoxSupplierSeeder;
use Database\Seeders\GoodSeeder;
use Database\Seeders\ItemSeeder;
use Database\Seeders\LocationSeeder;
use Database\Seeders\SettingSeeder;
use Database\Seeders\SupplierItemSeeder;
use Database\Seeders\SupplierSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\WarehouseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SetGoodTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_update_specific_fields_method(): void
    {
        $this->seed([
            SettingSeeder::class,
            UserSeeder::class,
            WarehouseSeeder::class,
            LocationSeeder::class,
            SupplierSeeder::class,
            SupplierItemSeeder::class,
            BoxSupplierSeeder::class,
            BoxSeeder::class,
            ItemSeeder::class,
            GoodSeeder::class,
        ]);

        $setGood = SetGood::factory()->create();

        $setGood->goods()->attach(1, ['quantity' => 5]);

        $good = Good::find(1);

        $setGood->updateSpecificFields();

        $this->assertSame(1, $setGood->good_count);

        $this->assertSame($good->goods_price, $setGood->goods_price);
    }
}

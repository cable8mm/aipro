<?php

namespace Tests\Feature\Models;

use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;
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

class PurchaseOrderTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_update_total_good_count_method(): void
    {
        $this->seed([
            SettingSeeder::class,
            UserSeeder::class,
            SupplierSeeder::class,
            WarehouseSeeder::class,
            LocationSeeder::class,
            SupplierItemSeeder::class,
            BoxSupplierSeeder::class,
            BoxSeeder::class,
            ItemSeeder::class,
        ]);

        $purchaseOrder = PurchaseOrder::factory()->create();

        PurchaseOrderItem::factory()->state([
            'purchase_order_id' => $purchaseOrder->id,
            'subtotal' => 10000,
        ])->count(3)->create();

        $purchaseOrder->updateTotalGoodCount();

        $this->assertSame(3, $purchaseOrder->total_good_count);
        $this->assertSame(30000, $purchaseOrder->total_order_price);
    }
}

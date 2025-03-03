<?php

namespace Tests\Feature\Models;

use App\Enums\PurchaseOrderItemStatus;
use App\Models\PurchaseOrderItem;
use Database\Seeders\BoxSeeder;
use Database\Seeders\BoxSupplierSeeder;
use Database\Seeders\ItemSeeder;
use Database\Seeders\LocationSeeder;
use Database\Seeders\PurchaseOrderItemSeeder;
use Database\Seeders\PurchaseOrderSeeder;
use Database\Seeders\SettingSeeder;
use Database\Seeders\SupplierItemSeeder;
use Database\Seeders\SupplierSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\WarehouseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PurchaseOrderItemTest extends TestCase
{
    use RefreshDatabase;

    public function test_returned_method(): void
    {
        $this->seed([
            SettingSeeder::class,
            UserSeeder::class,
            WarehouseSeeder::class,
            LocationSeeder::class,
            SupplierSeeder::class,
            BoxSupplierSeeder::class,
            BoxSeeder::class,
            SupplierItemSeeder::class,
            ItemSeeder::class,
            PurchaseOrderSeeder::class,
            PurchaseOrderItemSeeder::class,
        ]);

        $old = PurchaseOrderItem::factory()->state([
            'status' => PurchaseOrderItemStatus::PENDING,
        ])->create();

        $new = $old->returned(1);

        $this->assertSame($new->quantity, 1);
        $this->assertSame($new->subtotal, 1 * $old->unit_price);
    }
}

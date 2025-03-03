<?php

namespace Tests\Feature\Models;

use App\Enums\PurchaseOrderItemStatus;
use App\Models\BoxPurchaseOrderItem;
use Database\Seeders\BoxPurchaseOrderItemSeeder;
use Database\Seeders\BoxPurchaseOrderSeeder;
use Database\Seeders\BoxSeeder;
use Database\Seeders\BoxSupplierSeeder;
use Database\Seeders\LocationSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\WarehouseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BoxPurchaseOrderItemTest extends TestCase
{
    use RefreshDatabase;

    public function test_returned_method(): void
    {
        $this->seed([
            UserSeeder::class,
            WarehouseSeeder::class,
            LocationSeeder::class,
            BoxSupplierSeeder::class,
            BoxSeeder::class,
            BoxPurchaseOrderSeeder::class,
            BoxPurchaseOrderItemSeeder::class,
        ]);

        $old = BoxPurchaseOrderItem::factory()->state([
            'status' => PurchaseOrderItemStatus::PENDING,
        ])->create();

        $new = $old->returned(1);

        $this->assertSame($new->quantity, 1);
        $this->assertSame($new->subtotal, 1 * $old->unit_price);
    }
}

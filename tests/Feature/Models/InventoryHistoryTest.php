<?php

namespace Tests\Feature\Models;

use App\Models\InventoryHistory;
use Database\Seeders\BoxSeeder;
use Database\Seeders\BoxSupplierSeeder;
use Database\Seeders\InventoryHistorySeeder;
use Database\Seeders\ItemSeeder;
use Database\Seeders\LocationSeeder;
use Database\Seeders\SettingSeeder;
use Database\Seeders\SupplierItemSeeder;
use Database\Seeders\SupplierSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\WarehouseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InventoryHistoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_cancelling_method(): void
    {
        $this->seed([
            UserSeeder::class,
            SettingSeeder::class,
            WarehouseSeeder::class,
            LocationSeeder::class,
            SupplierSeeder::class,
            SupplierItemSeeder::class,
            BoxSupplierSeeder::class,
            BoxSeeder::class,
            ItemSeeder::class,
            InventoryHistorySeeder::class,
        ]);

        $old = InventoryHistory::orderBy('id', 'desc')->first();

        $this->assertTrue($old->canCancelling());

        $old->cancelling();

        $new = InventoryHistory::orderBy('id', 'desc')->first();

        $this->assertSame($old->quantity * -1, $new->quantity);

        $this->assertFalse($old->cannotCancelling());
    }
}

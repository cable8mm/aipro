<?php

namespace Tests\Feature\Models;

use App\Models\BoxInventoryHistory;
use Database\Seeders\BoxInventoryHistorySeeder;
use Database\Seeders\BoxSeeder;
use Database\Seeders\BoxSupplierSeeder;
use Database\Seeders\LocationSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\WarehouseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BoxInventoryHistoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_cancelling_method(): void
    {
        $this->seed([
            UserSeeder::class,
            WarehouseSeeder::class,
            LocationSeeder::class,
            BoxSupplierSeeder::class,
            BoxSeeder::class,
            BoxInventoryHistorySeeder::class,
        ]);

        $old = BoxInventoryHistory::orderBy('id', 'desc')->first();

        $this->assertTrue($old->canCancelling());

        $old->cancelling();

        $new = BoxInventoryHistory::orderBy('id', 'desc')->first();

        $this->assertSame($old->quantity * -1, $new->quantity);

        $this->assertFalse($old->cannotCancelling());
    }
}

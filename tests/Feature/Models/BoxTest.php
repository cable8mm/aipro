<?php

namespace Tests\Feature\Models;

use App\Models\Box;
use App\Models\BoxSupplier;
use App\Models\Location;
use App\Models\User;
use App\Models\Warehouse;
use Database\Seeders\BoxSeeder;
use Database\Seeders\BoxSupplierSeeder;
use Database\Seeders\LocationSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\WarehouseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BoxTest extends TestCase
{
    use RefreshDatabase;

    public function test_plusminus_method(): void
    {
        $user = User::factory()->create();

        $boxSupplier = BoxSupplier::factory()->state([
            'author_id' => $user->id,
        ])->create();

        $warehouse = Warehouse::factory()->create();

        $location = Location::factory()->state([
            'warehouse_id' => $warehouse->id,
        ])->create();

        $box = Box::factory()->state([
            'author_id' => $user->id,
            'box_supplier_id' => $boxSupplier->id,
            'location_id' => $location->id,
            'inventory' => 100,
        ])->create();

        $old = $box->replicate();

        $box->plusminus(1, Box::class, $box->id);

        $new = $box;

        $this->assertSame($old->inventory + 1, $new->inventory);
    }

    public function test_default_method(): void
    {
        $this->seed([
            UserSeeder::class,
            WarehouseSeeder::class,
            LocationSeeder::class,
            BoxSupplierSeeder::class,
            BoxSeeder::class,
        ]);

        $count = Box::where('is_default', true)->count();

        $this->assertSame(1, $count);
    }
}

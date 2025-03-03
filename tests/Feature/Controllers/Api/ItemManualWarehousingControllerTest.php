<?php

namespace Tests\Feature\Controllers\Api;

use App\Enums\ItemManualWarehousingType;
use App\Models\Item;
use App\Models\User;
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

class ItemManualWarehousingControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_visited_under_logout(): void
    {
        $response = $this->postJson(route('item-manual-warehousings.store', [
            'item_id' => 1,
            'amount' => 100,
            'type' => ItemManualWarehousingType::CHECK->value,
            'memo' => 'Test',
        ]));

        $response->assertStatus(401);
    }

    public function test_store_visited_under_login(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

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
        ]);

        $response = $this->postJson(route('item-manual-warehousings.store', [
            'item_id' => 1,
            'amount' => 100,
            'type' => ItemManualWarehousingType::CHECK->value,
            'memo' => 'Test',
        ]));

        $response->assertStatus(201);
    }

    public function test_store_from_barcode_visited_under_logout(): void
    {
        $response = $this->postJson(route('item-manual-warehousings.store-from-barcode', [
            'barcode' => 1,
            'amount' => 100,
            'type' => ItemManualWarehousingType::CHECK->value,
            'memo' => 'Test',
        ]));

        $response->assertStatus(401);
    }

    public function test_store_from_barcode_visited_under_login(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

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
        ]);

        $item = Item::first();

        $response = $this->postJson(route('item-manual-warehousings.store-from-barcode', [
            'barcode' => $item->barcode,
            'amount' => 100,
            'type' => ItemManualWarehousingType::CHECK->value,
            'memo' => 'Test',
        ]));

        $response->assertStatus(201);
    }
}

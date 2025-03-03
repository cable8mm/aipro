<?php

namespace Tests\Feature\Controllers\Api;

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

class ItemControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_visited_under_logout(): void
    {
        $response = $this->getJson(route('items'));

        $response->assertStatus(401);
    }

    public function test_index_visited_under_login(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->getJson(route('items'));

        $response->assertStatus(200);
    }

    public function test_show_visited_under_logout(): void
    {
        $response = $this->getJson(route('items.show', [
            'item' => 1,
        ]));

        $response->assertStatus(401);
    }

    public function test_show_visited_under_login(): void
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

        $response = $this->getJson(route('items.show', [
            'item' => 1,
        ]));

        $response->assertStatus(200);
    }

    public function test_show_from_sku_visited_under_logout(): void
    {
        $response = $this->getJson(route('items.show-from-sku', [
            'sku' => 1,
        ]));

        $response->assertStatus(401);
    }

    public function test_show_from_sku_visited_under_login(): void
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

        $response = $this->getJson(route('items.show-from-sku', [
            'sku' => 1,
        ]));

        $response->assertStatus(200);
    }

    public function test_show_from_barcode_visited_under_logout(): void
    {
        $response = $this->getJson(route('items.show-from-barcode', [
            'barcode' => 123123,
        ]));

        $response->assertStatus(401);
    }

    public function test_show_from_barcode_visited_under_login(): void
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

        $response = $this->getJson(route('items.show-from-barcode', [
            'barcode' => $item->barcode,
        ]));

        $response->assertStatus(200);
    }
}

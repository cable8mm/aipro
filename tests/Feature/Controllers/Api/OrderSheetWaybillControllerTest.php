<?php

namespace Tests\Feature\Controllers\Api;

use App\Models\Order;
use App\Models\OrderShipment;
use App\Models\User;
use Database\Seeders\BoxSeeder;
use Database\Seeders\BoxSupplierSeeder;
use Database\Seeders\ItemSeeder;
use Database\Seeders\LocationSeeder;
use Database\Seeders\OrderSeeder;
use Database\Seeders\OrderSheetWaybillSeeder;
use Database\Seeders\OrderShipmentSeeder;
use Database\Seeders\SettingSeeder;
use Database\Seeders\SupplierItemSeeder;
use Database\Seeders\SupplierSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\WarehouseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderSheetWaybillControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_print_visited_under_logout(): void
    {
        $response = $this->getJson(route('order-sheet-waybills.print', [
            'orderSheetWaybill' => 1,
        ]));

        $response->assertStatus(401);
    }

    public function test_store_visited_under_login(): void
    {
        // TODO Write tests

        $this->assertTrue(true);

        // $user = User::factory()->create();

        // $this->actingAs($user);

        // $this->seed([
        //     SettingSeeder::class,
        //     UserSeeder::class,
        //     WarehouseSeeder::class,
        //     LocationSeeder::class,
        //     SupplierSeeder::class,
        //     SupplierItemSeeder::class,
        //     OrderSheetWaybillSeeder::class,
        //     BoxSupplierSeeder::class,
        //     BoxSeeder::class,
        //     OrderSeeder::class,
        //     ItemSeeder::class,
        //     OrderShipmentSeeder::class,
        //     OrderSheetWaybillSeeder::class,
        // ]);

        // $orderShipment = OrderShipment::first();

        // Order::factory()->state([
        //     'order_sheet_waybill_id' => 1,
        //     'id' => $orderShipment->orderNo,
        // ])->create();

        // $response = $this->getJson(route('order-sheet-waybills.print', [
        //     'orderSheetWaybill' => 1,
        // ]));

        // $response->assertStatus(200);
    }
}

<?php

namespace Tests\Feature\Controllers\Api;

use App\Models\Order;
use App\Models\User;
use Database\Seeders\BoxSeeder;
use Database\Seeders\BoxSupplierSeeder;
use Database\Seeders\LocationSeeder;
use Database\Seeders\OrderSeeder;
use Database\Seeders\OrderSheetWaybillSeeder;
use Database\Seeders\OrderShipmentSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\WarehouseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_visited_under_logout(): void
    {
        $response = $this->getJson(route('orders.print', [
            'order' => 1,
        ]));

        $response->assertStatus(401);
    }

    public function test_store_visited_under_login(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $this->seed([
            UserSeeder::class,
            WarehouseSeeder::class,
            LocationSeeder::class,
            OrderSheetWaybillSeeder::class,
            BoxSupplierSeeder::class,
            BoxSeeder::class,
            OrderSeeder::class,
        ]);

        $response = $this->getJson(route('orders.print', [
            'order' => 1,
        ]));

        $response->assertStatus(404);
    }

    public function test_waybill_visited_under_logout(): void
    {
        $response = $this->getJson(route('orders.waybill', [
            'order' => 1,
        ]));

        $response->assertStatus(401);
    }

    public function test_waybill_visited_under_login(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $this->seed([
            UserSeeder::class,
            WarehouseSeeder::class,
            LocationSeeder::class,
            OrderSheetWaybillSeeder::class,
            BoxSupplierSeeder::class,
            BoxSeeder::class,
            OrderSeeder::class,
        ]);

        $response = $this->getJson(route('orders.waybill', [
            'order' => 1,
        ]));

        $response->assertStatus(404);
    }

    public function test_update_visited_under_logout(): void
    {
        $response = $this->postJson(route('orders.waybill', [
            'order' => 1,
        ]));

        $response->assertStatus(405);
    }

    public function test_update_visited_under_login(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        // TODO: Write tests as soon as possible

        $this->assertTrue(true);
    }

    public function test_clear_order_visited_under_logout(): void
    {
        $response = $this->getJson(route('orders.clear-order', [
            'order' => 1,
        ]));

        $response->assertStatus(401);
    }

    public function test_clear_order_visited_under_login(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $this->seed([
            UserSeeder::class,
            WarehouseSeeder::class,
            LocationSeeder::class,
            OrderSheetWaybillSeeder::class,
            BoxSupplierSeeder::class,
            BoxSeeder::class,
            OrderSeeder::class,
            OrderShipmentSeeder::class,
        ]);

        $order = Order::first();

        $response = $this->getJson(route('orders.clear-order', [
            'order' => $order->id,
        ]));

        $response->assertStatus(200);
    }

    public function test_order_shipments_visited_under_logout(): void
    {
        $response = $this->getJson(route('orders.order-shipments', [
            'waybill_numbers' => 1,
        ]));

        $response->assertStatus(401);
    }

    public function test_order_shipments_visited_under_login(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $this->seed([
            UserSeeder::class,
            WarehouseSeeder::class,
            LocationSeeder::class,
            OrderSheetWaybillSeeder::class,
            BoxSupplierSeeder::class,
            BoxSeeder::class,
            OrderSeeder::class,
            OrderShipmentSeeder::class,
        ]);

        $order = Order::first();

        $response = $this->getJson(route('orders.order-shipments', [
            'waybill_numbers' => $order->waybill_numbers,
        ]));

        $response->assertStatus(200);
    }
}

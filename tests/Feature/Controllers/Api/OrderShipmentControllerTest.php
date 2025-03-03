<?php

namespace Tests\Feature\Controllers\Api;

use App\Models\User;
use Database\Seeders\OrderSheetWaybillSeeder;
use Database\Seeders\OrderShipmentSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderShipmentControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_visited_under_logout(): void
    {
        $response = $this->getJson(route('order-shipments', [
            'order_no' => 1,
        ]));

        $response->assertStatus(401);
    }

    public function test_index_visited_under_login(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->getJson(route('order-shipments', [
            'order_no' => 1,
        ]));

        $response->assertStatus(200);
    }

    public function test_show_visited_under_logout(): void
    {
        $response = $this->getJson(route('order-shipments.show', [
            'order_shipment' => 1,
        ]));

        $response->assertStatus(401);
    }

    public function test_show_visited_under_login(): void
    {
        $this->seed([
            UserSeeder::class,
            OrderSheetWaybillSeeder::class,
            OrderShipmentSeeder::class,
        ]);

        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->getJson(route('order-shipments.show', [
            'order_shipment' => 1,
        ]));

        $response->assertStatus(200);
    }

    public function test_pause_visited_under_logout(): void
    {
        $response = $this->getJson(route('order-shipments.pause'));

        $response->assertStatus(401);
    }

    public function test_pause_visited_under_login(): void
    {
        $this->seed([
            UserSeeder::class,
            OrderSheetWaybillSeeder::class,
            OrderShipmentSeeder::class,
        ]);

        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->getJson(route('order-shipments.pause'));

        $response->assertStatus(200);
    }
}

<?php

namespace Tests\Feature\Controllers\Api;

use App\Models\User;
use Database\Seeders\BoxSeeder;
use Database\Seeders\BoxSupplierSeeder;
use Database\Seeders\LocationSeeder;
use Database\Seeders\OrderSeeder;
use Database\Seeders\OrderSheetWaybillSeeder;
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
            'order_sheet_waybill' => 1,
        ]));

        $response->assertStatus(401);
    }

    public function test_store_visited_under_login(): void
    {
        ob_start();

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
            OrderSheetWaybillSeeder::class,
        ]);

        $response = $this->getJson(route('order-sheet-waybills.print', [
            'order_sheet_waybill' => 1,
        ]));

        $buffer = ob_get_contents();
        ob_end_clean();

        $response->assertStatus(200);
    }
}

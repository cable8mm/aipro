<?php

namespace Tests\Feature\Models;

use App\Models\OrderSheetWaybill;
use Database\Seeders\OrderSheetWaybillSeeder;
use Database\Seeders\OrderShipmentSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderSheetWaybillTest extends TestCase
{
    use RefreshDatabase;

    public function test_orders_with_site_order_no_method(): void
    {
        $this->seed([
            UserSeeder::class,
            OrderSheetWaybillSeeder::class,
            OrderShipmentSeeder::class,
        ]);

        $orderSheetWaybill = OrderSheetWaybill::first();

        $orderShipments = $orderSheetWaybill->ordersWithSiteOrderNo();

        $this->assertIsArray($orderShipments);
    }
}

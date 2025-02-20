<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PurchaseOrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\PurchaseOrderItem::factory()->count(10)->create();
    }
}

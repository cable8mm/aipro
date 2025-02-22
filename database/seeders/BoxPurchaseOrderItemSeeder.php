<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BoxPurchaseOrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\BoxPurchaseOrderItem::factory()->count(100)->create();
    }
}

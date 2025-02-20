<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BoxPurchaseOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\BoxPurchaseOrder::factory()->count(10)->create();
    }
}

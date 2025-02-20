<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PurchaseOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\PurchaseOrder::factory()->count(10)->create();
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PurchaseOrderBoxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\PurchaseOrderBox::factory()->count(10)->create();
    }
}

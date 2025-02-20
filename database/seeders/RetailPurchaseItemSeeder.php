<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RetailPurchaseItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\RetailPurchaseItem::factory()->count(10)->create();
    }
}

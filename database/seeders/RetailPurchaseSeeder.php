<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RetailPurchaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\RetailPurchase::factory()->count(10)->create();
    }
}

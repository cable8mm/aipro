<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SupplierGoodsBakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\SupplierGoodsBak::factory()->count(10)->create();
    }
}

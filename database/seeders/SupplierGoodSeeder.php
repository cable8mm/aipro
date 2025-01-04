<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SupplierGoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\SupplierGood::factory()->count(10)->create();
    }
}

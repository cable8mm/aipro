<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BoxSupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\BoxSupplier::factory()->count(10)->create();
    }
}

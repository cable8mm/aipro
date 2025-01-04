<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class B2bGoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\B2bGood::factory()->count(10)->create();
    }
}

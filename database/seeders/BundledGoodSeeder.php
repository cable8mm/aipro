<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BundledGoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\BundledGood::factory()->count(10)->create();
    }
}

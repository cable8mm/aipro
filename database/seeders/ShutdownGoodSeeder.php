<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ShutdownGoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\ShutdownGood::factory()->count(10)->create();
    }
}

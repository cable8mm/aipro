<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PlayautoGoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\PlayautoGood::factory()->count(10)->create();
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PlayautoMasterCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\PlayautoMasterCode::factory()->count(10)->create();
    }
}

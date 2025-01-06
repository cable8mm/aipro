<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AlertEmailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\AlertEmail::factory()->count(10)->create();
    }
}

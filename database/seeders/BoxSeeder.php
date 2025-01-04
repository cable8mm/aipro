<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BoxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Box::factory()->count(10)->create();
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BoxOrderBoxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\BoxOrderBox::factory()->count(10)->create();
    }
}

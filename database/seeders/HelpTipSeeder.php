<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class HelpTipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\HelpTip::factory()->count(10)->create();
    }
}

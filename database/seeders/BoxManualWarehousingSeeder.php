<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BoxManualWarehousingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\BoxManualWarehousing::factory()->count(10)->create();
    }
}

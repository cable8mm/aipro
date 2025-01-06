<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ChannelGoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\ChannelGood::factory()->count(10)->create();
    }
}

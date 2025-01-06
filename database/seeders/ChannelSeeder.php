<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ChannelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Channel::factory()->count(10)->create();
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ChannelFeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\ChannelFee::factory()->count(10)->create();
    }
}

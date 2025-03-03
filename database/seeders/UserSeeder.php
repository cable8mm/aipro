<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    const COUNT = 10;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::factory()->count(self::COUNT)->create();
    }
}

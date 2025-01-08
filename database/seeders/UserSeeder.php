<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class UserSeeder extends Seeder
{
    const COUNT = 10;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::factory()->count(self::COUNT)->create();

        Artisan::call('aipro:create-nova-account');
    }
}

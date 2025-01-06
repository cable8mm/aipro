<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class IssueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Issue::factory()->count(10)->create();
    }
}

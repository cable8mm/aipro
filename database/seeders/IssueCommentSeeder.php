<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class IssueCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\IssueComment::factory()->count(10)->create();
    }
}

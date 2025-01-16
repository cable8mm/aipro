<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BoxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i < 11; $i++) {
            \App\Models\Box::factory(1, [
                'name' => '센터'.$i.'호',
                'code' => 'BOX-'.$i,
            ])->create();
        }
    }
}

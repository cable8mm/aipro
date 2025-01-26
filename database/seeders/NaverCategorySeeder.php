<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class NaverCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (($handle = fopen(base_path('tests/files/naver_categories.csv'), 'r')) !== false) {
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                \App\Models\NaverCategory::factory(1, [
                    'id' => $data[0],
                    'cateCd' => $data[1],
                    'naver_category' => $data[2],
                ])->create();
            }
            fclose($handle);
        }
    }
}

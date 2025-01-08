<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PlayautoCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $row = 1;
        if (($handle = fopen(base_path('docs/csv/playauto_categories_for_test.csv'), 'r')) !== false) {
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                $num = count($data);
                $row++;
                \App\Models\PlayautoCategory::factory(1, [
                    'id' => $data[0],
                    'depth1' => $data[1],
                    'depth2' => $data[2],
                    'depth3' => $data[3],
                    'depth4' => $data[4],
                    'is_active' => $data[5],
                ])->create();
            }
            fclose($handle);
        }
    }
}

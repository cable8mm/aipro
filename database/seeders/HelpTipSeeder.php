<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class HelpTipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $row = 1;
        if (($handle = fopen(base_path('docs/csv/help_tips.csv'), 'r')) !== false) {
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                $num = count($data);
                $row++;
                \App\Models\HelpTip::factory(1, [
                    'word' => $data[0],
                    'help_tip' => $data[1],
                ])->create();
            }
            fclose($handle);
        }
    }
}

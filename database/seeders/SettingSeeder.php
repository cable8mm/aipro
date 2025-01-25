<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'key' => 'OPEN_MARKET_MINIMUM_INVENTORY',
                'value' => 2,
                'memo' => '이 수치 미만(포함 안됨)일 경우 품절처리 됨',
            ],
            [
                'key' => 'GOAL_FOR_COST_PRICE_SUM_OF_GOODS',
                'value' => 20000000,
                'memo' => '목표 상품매입가 합',
            ],
            [
                'key' => 'GOAL_FOR_COST_PRICE_SUM_OF_BOXES',
                'value' => 100000000,
                'memo' => '목표 박스매입가 합',
            ],
            [
                'key' => 'GOAL_FOR_INVENTORY_SUM_OF_BOXES',
                'value' => 40000,
                'memo' => '목표 박스재고 합',
            ],
        ];

        foreach ($settings as $setting) {
            \App\Models\Setting::factory()->create($setting);
        }
    }
}

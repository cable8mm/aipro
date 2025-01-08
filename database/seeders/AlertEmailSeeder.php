<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AlertEmailSeeder extends Seeder
{
    private array $actions = [
        [
            'send_inventory',
            '재고 상태 및 체크리스트(월~금 오전 8시 즈음)',
        ],
        [
            'send_goods_checklist',
            '상품 관리 및 체크리스트(월~금 오전 8시 즈음)',
        ],
        [
            'send_system_order_checklist',
            '시스템 발주를 위한 체크 리스트(월~금 오전 8시 즈음)',
        ],
        [
            'request_shutdown',
            'D등급 x 재고0 x 판매중 상품 처리(월~금 17시 50분 즈음)',
        ],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->actions as $action) {
            \App\Models\AlertEmail::factory()->create([
                'name' => $action[1],
                'action_name' => $action[0],
            ]);
        }
    }
}

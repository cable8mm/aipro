<?php

declare(strict_types=1);

return [
    'item-status' => [
        'ACTIVE'      => '정상 판매 중',
        'DISCONTINUED' => '단종됨',
        'OUT_OF_STOCK'     => '재고 없음',
        'PENDING'      => '대기 상태',
    ],
    'item-inventory-level' => [
        'LEVEL_1' => '1등급',
        'LEVEL_2' => '2등급',
        'LEVEL_3' => '3등급',
        'LEVEL_X' => 'X등급',
    ],
    'inventory-history-type' => [
        'WAREHOUSING' => '입고',
        'WAREHOUSING_CANCELED' => '입고 취소',
        'SHIPPING' => '출고',
        'SHIPPING_CANCELED' => '출고 취소',
    ],
    'supplier-pricing-policy' => [
        'FLEXIBLE' => '자유 가격',
        'GUIDED' => '권장 가격',
        'FIXED' => '고정 가격',
    ],
];

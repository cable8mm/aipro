<?php

declare(strict_types=1);

return [
    'item-status' => [
        'ACTIVE' => 'Active',
        'DISCONTINUED' => 'Discontinued',
        'OUT_OF_STOCK' => 'Out Of Stock',
        'PENDING' => 'Pending',
    ],
    'item-inventory-level' => [
        'LEVEL_1' => 'Level 1',
        'LEVEL_2' => 'Level 2',
        'LEVEL_3' => 'Level 3',
        'LEVEL_X' => 'Level X',
    ],
    'inventory-history-type' => [
        'WAREHOUSING' => 'Warehousing',
        'WAREHOUSING_CANCELED' => 'Warehousing Canceled',
        'SHIPPING' => 'Shipping',
        'SHIPPING_CANCELED' => 'Shipping Canceled',
    ],
    'supplier-pricing-policy' => [
        'FLEXIBLE' => 'Flexible',
        'GUIDED' => 'Guided',
        'FIXED' => 'Fixed',
    ],
    'import-type' => [
        'ITEM' => 'Item',
        'ORDER_SHEET_WAYBILL' => 'Order Sheet Waybill',
    ],
    'manual-inventory-adjustment-type' => [
        'CLIENT_RETURN' => 'Client Return',
        'EXCHANGE' => 'Exchange',
        'WRONG_DELIVERY' => 'Wrong Delivery',
        'CHECK' => 'Check',
        'SUPPLIER_RETURN' => 'Supplier Return',
        'DISPOSAL' => 'Disposal',
        'MISTAKE' => 'Mistake',
    ],
    'mismatched-order-shipment-status' => [
        'READY' => 'Ready',
        'FAILED' => 'Failed',
        'COMPLETED' => 'Completed',
    ],
    'order-method' => [
        'SMS' => 'SMS',
        'EMAIL' => 'Email',
        'PHONE' => 'Phone',
        'KAKAOTALK' => 'KakaoTalk',
        'ORDER_SYSTEM' => 'Order System',
    ],
    'order-sheet-waybill-status' => [
        'FILE_UPLOADED' => 'File Uploaded',
        'FILE_ON_SUCCESS' => 'File On Success',
        'RUNNING' => 'Running',
        'SUCCESS' => 'Success',
        'CANCEL' => 'Cancel',
        'ERROR' => 'Error',
    ],
    'order-shipment-delivery-type' => [
        'WAITING' => 'Waiting',
        'RUNNING' => 'Running',
        'FAILED' => 'Failed',
        'SUCCESS' => 'Success',
    ],
    'user-type' => [
        'ADMINISTRATOR' => 'Administrator',
        'DEVELOPER' => 'Developer',
        'MANAGER' => 'Manager',
        'MD' => 'MD',
        'WAREHOUSER' => 'Warehouser',
        'REVIEWER' => 'Reviewer',
    ],
    'retail-purchase-status' => [
        'COMPLETED' => 'Completed',
        'PENDING' => 'Pending',
        'CANCELED' => 'Canceled',
        'REFUNDED' => 'Refunded',
    ],
    'payment-method' => [
        'CASH' => 'Cash',
        'CARD' => 'Card',
        'MOBILE' => 'Mobile',
        'OTHER' => 'Other',
    ],
    'purchase-order-status' => [
        'PENDING' => 'Pending',
        'STORED' => 'Stored',
        'RETURNED' => 'Returned',
    ],
    'purchase-order-item-status' => [
        'PENDING'  => '입고 대기',
        'RECEIVED' => '입고 완료',
        'INSPECTED' => '검수 완료',
        'STORED' => '보관 완료',
        'DAMAGED' => '손상됨',
        'RETURNED' => '반품 처리',
        'CANCELED' => '취소',
    ],
];

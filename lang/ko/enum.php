<?php

declare(strict_types=1);

return [
    'item-status' => [
        'ACTIVE' => '정상 판매 중',
        'DISCONTINUED' => '단종됨',
        'OUT_OF_STOCK' => '재고 없음',
        'PENDING' => '대기 상태',
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
    'import-type' => [
        'ITEM' => '상품',
        'ORDER_SHEET_WAYBILL' => '주문서 송장',
    ],
    'manual-inventory-adjustment-type' => [
        'CLIENT_RETURN' => '고객반품',
        'EXCHANGE' => '고객교환',
        'WRONG_DELIVERY' => '오배송교환',
        'CHECK' => '실사조정',
        'SUPPLIER_RETURN' => '공급사반품',
        'DISPOSAL' => '폐기',
        'MISTAKE' => '오기입',
    ],
    'mismatched-order-shipment-status' => [
        'READY' => '미처리',
        'FAILED' => '실패',
        'COMPLETED' => '처리완료',
    ],
    'order-method' => [
        'SMS' => '문자 메시지',
        'EMAIL' => '이메일',
        'PHONE' => '전화',
        'KAKAOTALK' => '카카오톡',
        'ORDER_SYSTEM' => '발주 시스템',
    ],
    'order-sheet-waybill-status' => [
        'FILE_UPLOADED' => '파일업로드',
        'FILE_ON_SUCCESS' => '정상확인완료',
        'RUNNING' => '작업중',
        'SUCCESS' => '주문서입력완료',
        'CANCEL' => '취소',
        'ERROR' => '에러',
    ],
    'order-shipment-delivery-type' => [
        'WAITING' => '대기',
        'RUNNING' => '작업중',
        'FAILED' => '실패',
        'SUCCESS' => '성공',
    ],
    'user-type' => [
        'ADMINISTRATOR' => '최고관리자',
        'DEVELOPER' => '개발자',
        'MANAGER' => '관리자',
        'MD' => '엠디',
        'WAREHOUSER' => '공무직',
        'REVIEWER' => '리뷰어',
    ],
    'retail-purchase-status' => [
        'COMPLETED' => '완료',
        'PENDING' => '대기',
        'CANCELED' => '취소',
        'REFUNDED' => '환불',
    ],
    'payment-method' => [
        'CASH' => '현금',
        'CARD' => '카드',
        'MOBILE' => '휴대폰',
        'OTHER' => '기타',
    ],
    'purchase-order-status' => [
        'PENDING' => '입고 대기',
        'STORED' => '보관 완료',
        'RETURNED' => '반품 처리',
    ],
    'purchase-order-item-status' => [
        'PENDING' => '입고 대기',
        'RECEIVED' => '입고 완료',
        'INSPECTED' => '검수 완료',
        'STORED' => '보관 완료',
        'DAMAGED' => '손상됨',
        'RETURNED' => '반품 처리',
        'CANCELED' => '취소',
    ],
];

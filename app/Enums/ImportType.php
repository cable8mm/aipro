<?php

namespace App\Enums;

use Cable8mm\EnumGetter\EnumGetter;

enum ImportType: string
{
    use EnumGetter;

    case GOOD = 'good';
    case ORDER_SHEET_WAYBILL = 'order sheet waybills';

    public function value(): string
    {
        return match ($this) {
            self::GOOD => '상품',
            self::ORDER_SHEET_WAYBILL => '주문서 송장',
        };
    }
}

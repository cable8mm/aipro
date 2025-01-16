<?php

namespace App\Enums;

use Cable8mm\EnumGetter\EnumGetter;

enum InventoryHistory: string
{
    use EnumGetter;

    case WAREHOUSING = 'warehousing';
    case WAREHOUSING_CANCELED = 'warehousing_canceled';
    case SHIPPING = 'shipping';
    case SHIPPING_CANCELED = 'shipping_canceled';
    case CANCELED = 'canceled';

    public function value(): string
    {
        return match ($this) {
            self::WAREHOUSING => '입고',
            self::WAREHOUSING_CANCELED => '입고취소',
            self::SHIPPING => '출고',
            self::SHIPPING_CANCELED => '출고취소',
            self::CANCELED => '취소',
        };
    }
}

<?php

namespace App\Enums;

use Cable8mm\EnumGetter\EnumGetter;

enum ItemManualWarehousingType: string
{
    use EnumGetter;

    case CLIENT_RETURN = 'Client Return';
    case EXCHANGE = 'Exchange';
    case WRONG_DELIVERY = 'Wrong Delivery';
    case CHECK = 'check';
    case SUPPLIER_RETURN = 'Supplier Return';
    case DISPOSAL = 'Disposal';
    case MISTAKE = 'Mistake';

    public function value(): string
    {
        return match ($this) {
            self::CLIENT_RETURN => __('enum.item-manual-warehousing-type.CLIENT_RETURN'),
            self::EXCHANGE => __('enum.item-manual-warehousing-type.EXCHANGE'),
            self::WRONG_DELIVERY => __('enum.item-manual-warehousing-type.WRONG_DELIVERY'),
            self::CHECK => __('enum.item-manual-warehousing-type.CHECK'),
            self::SUPPLIER_RETURN => __('enum.item-manual-warehousing-type.SUPPLIER_RETURN'),
            self::DISPOSAL => __('enum.item-manual-warehousing-type.DISPOSAL'),
            self::MISTAKE => __('enum.item-manual-warehousing-type.MISTAKE'),
        };
    }
}

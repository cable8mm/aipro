<?php

namespace App\Enums;

use Cable8mm\EnumGetter\EnumGetter;

enum ImportType: string
{
    use EnumGetter;

    case ITEM = 'Item';
    case ORDER_SHEET_WAYBILL = 'Order Sheet Waybills';

    public function value(): string
    {
        return match ($this) {
            self::ITEM => __('enum.import-type.UPLOAD_COMPLETED'),
            self::ORDER_SHEET_WAYBILL => __('enum.import-type.ORDER_SHEET_WAYBILL'),
        };
    }
}

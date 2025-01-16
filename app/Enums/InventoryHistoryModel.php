<?php

namespace App\Enums;

use Cable8mm\EnumGetter\EnumGetter;

enum InventoryHistoryModel: string
{
    use EnumGetter;

    case GOOD_MANUAL_WAREHOUSING = 'GoodManualWarehousing';
    case ORDER = 'Order';
    case ORDER_GOOD = 'OrderGood';
    case PLACING_ORDER_GOOD = 'PlacingOrderGood';
    case ORDER_SHIPMENT = 'OrderShipment';

    public function name(): string
    {
        return match ($this) {
            self::GOOD_MANUAL_WAREHOUSING => 'GoodManualWarehousing',
            self::ORDER => 'Order',
            self::ORDER_GOOD => 'OrderGood',
            self::PLACING_ORDER_GOOD => 'PlacingOrderGood',
            self::ORDER_SHIPMENT => 'OrderShipment',
        };
    }
}

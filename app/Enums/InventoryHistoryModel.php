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

    public function value(): string
    {
        return match ($this) {
            self::GOOD_MANUAL_WAREHOUSING => __('Good Manual Warehousing'),
            self::ORDER => __('Order'),
            self::ORDER_GOOD => __('Order Good'),
            self::PLACING_ORDER_GOOD => __('Placing Order Good'),
            self::ORDER_SHIPMENT => __('Order Shipment'),
        };
    }
}

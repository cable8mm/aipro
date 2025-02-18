<?php

namespace App\Enums;

use App\Models\GoodManualWarehousing;
use App\Models\Order;
use App\Models\OrderShipment;
use App\Models\PlacingOrderGood;
use Cable8mm\EnumGetter\EnumGetter;

enum InventoryHistoryModel: string
{
    use EnumGetter;

    case GOOD_MANUAL_WAREHOUSING = 'GoodManualWarehousing';
    case ORDER = 'Order';
    case PLACING_ORDER_GOOD = 'PlacingOrderGood';
    case ORDER_SHIPMENT = 'OrderShipment';

    public function value(): string
    {
        return match ($this) {
            self::GOOD_MANUAL_WAREHOUSING => GoodManualWarehousing::class,
            self::ORDER => Order::class,
            self::PLACING_ORDER_GOOD => PlacingOrderGood::class,
            self::ORDER_SHIPMENT => OrderShipment::class,
        };
    }
}

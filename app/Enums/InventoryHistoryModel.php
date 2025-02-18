<?php

namespace App\Enums;

use App\Models\ItemManualWarehousing;
use App\Models\Order;
use App\Models\OrderShipment;
use App\Models\PlacingOrderItem;
use Cable8mm\EnumGetter\EnumGetter;

enum InventoryHistoryModel: string
{
    use EnumGetter;

    case ITEM_MANUAL_WAREHOUSING = 'ItemManualWarehousing';
    case ORDER = 'Order';
    case PLACING_ORDER_ITEM = 'PlacingOrderItem';
    case ORDER_SHIPMENT = 'OrderShipment';

    public function value(): string
    {
        return match ($this) {
            self::ITEM_MANUAL_WAREHOUSING => ItemManualWarehousing::class,
            self::ORDER => Order::class,
            self::PLACING_ORDER_ITEM => PlacingOrderItem::class,
            self::ORDER_SHIPMENT => OrderShipment::class,
        };
    }
}

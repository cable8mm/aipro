<?php

namespace App\Enums;

use App\Models\ItemManualWarehousing;
use App\Models\Order;
use App\Models\OrderShipment;
use App\Models\PurchaseOrderItem;
use Cable8mm\EnumGetter\EnumGetter;

enum InventoryHistoryModel: string
{
    use EnumGetter;

    case ITEM_MANUAL_WAREHOUSING = 'ItemManualWarehousing';
    case ORDER = 'Order';
    case PURCHASE_ORDER_ITEM = 'PurchaseOrderItem';
    case ORDER_SHIPMENT = 'OrderShipment';

    public function value(): string
    {
        return match ($this) {
            self::ITEM_MANUAL_WAREHOUSING => ItemManualWarehousing::class,
            self::ORDER => Order::class,
            self::PURCHASE_ORDER_ITEM => PurchaseOrderItem::class,
            self::ORDER_SHIPMENT => OrderShipment::class,
        };
    }
}

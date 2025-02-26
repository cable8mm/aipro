<?php

namespace App\Enums;

use Cable8mm\EnumGetter\EnumGetter;

enum InventoryHistoryType: string
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
            self::WAREHOUSING => __('enum.inventory-history-type.WAREHOUSING'),
            self::WAREHOUSING_CANCELED => __('enum.inventory-history-type.WAREHOUSING_CANCELED'),
            self::SHIPPING => __('enum.inventory-history-type.SHIPPING'),
            self::SHIPPING_CANCELED => __('enum.inventory-history-type.SHIPPING_CANCELED'),
        };
    }

    public static function loadingWhen(): array
    {
        return [];
    }

    public static function failedWhen(): array
    {
        return [self::WAREHOUSING_CANCELED->name, self::SHIPPING_CANCELED->name];
    }

    public static function of(int $inventory, ?int $cancelId = null): static
    {
        if (is_null($cancelId)) {
            return $inventory > 0 ? self::WAREHOUSING : self::SHIPPING;
        }

        return $inventory > 0 ? self::SHIPPING_CANCELED : self::WAREHOUSING_CANCELED;
    }
}

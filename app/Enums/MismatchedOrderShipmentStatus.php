<?php

namespace App\Enums;

use Cable8mm\EnumGetter\EnumGetter;

enum MismatchedOrderShipmentStatus: string
{
    use EnumGetter;

    case READY = 'Ready';
    case FAILED = 'Failed';
    case COMPLETED = 'Completed';

    public function value(): string
    {
        return match ($this) {
            self::READY => __('enum.mismatched-order-shipment-status.READY'),
            self::FAILED => __('enum.mismatched-order-shipment-status.FAILED'),
            self::COMPLETED => __('enum.mismatched-order-shipment-status.COMPLETED'),
        };
    }

    public static function loadingWhen(): array
    {
        return [self::READY->name];
    }

    public static function failedWhen(): array
    {
        return [self::FAILED->name];
    }
}

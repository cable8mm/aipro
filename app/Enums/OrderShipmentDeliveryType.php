<?php

namespace App\Enums;

use Cable8mm\EnumGetter\EnumGetter;

enum OrderShipmentDeliveryType: string
{
    use EnumGetter;

    case WAITING = 'Waiting';
    case RUNNING = 'Running';
    case FAILED = 'Failed';
    case SUCCESS = 'Success';

    public function value(): string
    {
        return match ($this) {
            self::WAITING => __('enum.order-shipment-delivery-type.WAITING'),
            self::RUNNING => __('enum.order-shipment-delivery-type.RUNNING'),
            self::FAILED => __('enum.order-shipment-delivery-type.FAILED'),
            self::SUCCESS => __('enum.order-shipment-delivery-type.SUCCESS'),
        };
    }

    public static function loadingWhen(): array
    {
        return [self::WAITING->value, self::RUNNING->value];
    }

    public static function failedWhen(): array
    {
        return [self::FAILED->value];
    }
}

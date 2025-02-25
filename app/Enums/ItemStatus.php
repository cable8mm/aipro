<?php

namespace App\Enums;

use Cable8mm\EnumGetter\EnumGetter;

enum ItemStatus: string
{
    use EnumGetter;

    case ACTIVE = 'Active';
    case DISCONTINUED = 'Discontinued';
    case OUT_OF_STOCK = 'Out Of Stock';
    case PENDING = 'Pending';

    public function value(): string
    {
        return match ($this) {
            self::ACTIVE => __('status.item.ACTIVE'),
            self::DISCONTINUED => __('status.item.DISCONTINUED'),
            self::OUT_OF_STOCK => __('status.item.OUT_OF_STOCK'),
            self::PENDING => __('status.item.PENDING'),
        };
    }

    public static function loadingWhen(): array
    {
        return [self::PENDING->name];
    }

    public static function failedWhen(): array
    {
        return [self::OUT_OF_STOCK->name, self::DISCONTINUED->name];
    }
}

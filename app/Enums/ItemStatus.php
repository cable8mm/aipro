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
            self::ACTIVE => __('enum.item-status.ACTIVE'),
            self::DISCONTINUED => __('enum.item-status.DISCONTINUED'),
            self::OUT_OF_STOCK => __('enum.item-status.OUT_OF_STOCK'),
            self::PENDING => __('enum.item-status.PENDING'),
        };
    }

    public function status(?int $inventory = null, mixed $discontinuedAt = null)
    {
        if ($this === self::DISCONTINUED) {
            return self::DISCONTINUED;
        }

        if (! is_null($discontinuedAt)) {
            return self::DISCONTINUED;
        }

        if (is_null($inventory) || ($inventory === 0 && $this === self::PENDING)) {
            return self::PENDING;
        }

        if ($inventory === 0) {
            return self::OUT_OF_STOCK;
        }

        if ($inventory > 0) {
            return self::ACTIVE;
        }

        return $this;
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

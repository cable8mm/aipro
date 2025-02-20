<?php

namespace App\Enums;

use Cable8mm\EnumGetter\EnumGetter;

enum RetailPurchaseStatus: string
{
    use EnumGetter;

    case COMPLETED = 'completed';
    case PENDING = 'pending';
    case CANCELED = 'canceled';
    case REFUNDED = 'refunded';

    public function value(): string
    {
        return match ($this) {
            self::COMPLETED => __('Completed'),
            self::PENDING => __('Pending'),
            self::CANCELED => __('Canceled'),
            self::REFUNDED => __('Refunded'),
        };
    }

    public static function loadingWhen(): array
    {
        return [self::PENDING->name];
    }

    public static function failedWhen(): array
    {
        return [self::CANCELED->name, self::REFUNDED->name];
    }
}

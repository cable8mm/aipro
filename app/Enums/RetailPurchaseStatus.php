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

    /**
     * Whether the status can be changed.
     *
     * @param  RetailPurchaseStatus|string  $old  old status of retail purchase status
     * @param  RetailPurchaseStatus  $new  new status of retail purchase status
     * @return bool true if successful, false otherwise
     */
    public static function can(RetailPurchaseStatus|string $old, RetailPurchaseStatus $new): bool
    {
        if (is_string($old)) {
            $old = self::of($old);
        }

        return match ($old) {
            self::COMPLETED => match ($new) {
                self::PENDING, self::CANCELED, self::COMPLETED => false,
                default => true,
            },
            self::CANCELED, self::REFUNDED => false,
            default => true,
        };
    }

    /**
     * Whether the status can NOT be changed.
     *
     * @param  RetailPurchaseStatus|string  $old  old status of retail purchase status
     * @param  RetailPurchaseStatus  $new  new status of retail purchase status
     * @return bool true if successful, false otherwise
     */
    public static function cannot(RetailPurchaseStatus|string $old, RetailPurchaseStatus $new): bool
    {
        return self::can($old, $new) === false;
    }
}

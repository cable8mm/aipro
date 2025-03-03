<?php

namespace App\Enums;

use Cable8mm\EnumGetter\EnumGetter;

enum RetailPurchaseStatus: string
{
    use EnumGetter;

    case PENDING = 'Pending';
    case COMPLETED = 'Completed';
    case CANCELED = 'Canceled';
    case REFUNDED = 'Refunded';

    public function value(): string
    {
        return match ($this) {
            self::PENDING => __('enum.retail-purchase-status.PENDING'),
            self::COMPLETED => __('enum.retail-purchase-status.COMPLETED'),
            self::CANCELED => __('enum.retail-purchase-status.CANCELED'),
            self::REFUNDED => __('enum.retail-purchase-status.REFUNDED'),
        };
    }

    public static function loadingWhen(): array
    {
        return [self::PENDING];
    }

    public static function failedWhen(): array
    {
        return [self::CANCELED, self::REFUNDED];
    }

    /**
     * Whether the status can be changed.
     *
     * @param  RetailPurchaseStatus|string|null  $old  old status of retail purchase status
     * @param  RetailPurchaseStatus:string  $new  new status of retail purchase status
     * @return bool true if successful, false otherwise
     */
    public static function can(RetailPurchaseStatus|string|null $old, RetailPurchaseStatus|string $new): bool
    {
        if (is_null($old)) {
            return true;
        }

        if (is_string($old)) {
            $old = self::from($old);
        }

        if (is_string($new)) {
            $new = self::from($new);
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
     * @param  RetailPurchaseStatus|string|null  $old  old status of retail purchase status
     * @param  RetailPurchaseStatus|string  $new  new status of retail purchase status
     * @return bool true if successful, false otherwise
     */
    public static function cannot(RetailPurchaseStatus|string|null $old, RetailPurchaseStatus|string $new): bool
    {
        return self::can($old, $new) === false;
    }
}

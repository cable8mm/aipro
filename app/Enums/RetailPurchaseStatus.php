<?php

namespace App\Enums;

use Cable8mm\EnumGetter\EnumGetter;

enum RetailPurchaseStatus: string
{
    use EnumGetter;

    case COMPLETED = 'Completed';
    case PENDING = 'Pending';
    case CANCELED = 'Canceled';
    case REFUNDED = 'Refunded';

    public function value(): string
    {
        return match ($this) {
            self::COMPLETED => __('enum.retail-purchase-status.COMPLETED'),
            self::PENDING => __('enum.retail-purchase-status.PENDING'),
            self::CANCELED => __('enum.retail-purchase-status.CANCELED'),
            self::REFUNDED => __('enum.retail-purchase-status.REFUNDED'),
        };
    }

    public static function loadingWhen(): array
    {
        return [self::PENDING->value];
    }

    public static function failedWhen(): array
    {
        return [self::CANCELED->value, self::REFUNDED->value];
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
            $old = self::of($old);
        }

        if (is_string($new)) {
            $new = self::of($new);
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

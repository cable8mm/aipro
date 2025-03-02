<?php

namespace App\Enums;

use Cable8mm\EnumGetter\EnumGetter;

enum PurchaseOrderStatus: string
{
    use EnumGetter;

    case PENDING = 'Pending';
    case STORED = 'Stored';
    case RETURNED = 'Returned';

    public function value(): string
    {
        return match ($this) {
            self::PENDING => __('enum.purchase-order-status.PENDING'),
            self::STORED => __('enum.purchase-order-status.STORED'),
            self::RETURNED => __('enum.purchase-order-status.RETURNED'),
        };
    }

    public static function loadingWhen(): array
    {
        return [self::PENDING->value];
    }

    public static function failedWhen(): array
    {
        return [self::RETURNED->value];
    }

    /**
     * Whether the status can be changed.
     *
     * @param  PurchaseOrderStatus|string|null  $old  old status of purchase order status
     * @param  PurchaseOrderStatus:string  $new  new status of purchase order status
     * @return bool true if successful, false otherwise
     */
    public static function can(PurchaseOrderStatus|string|null $old, PurchaseOrderStatus|string $new): bool
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
            self::STORED => match ($new) {
                self::RETURNED => true,
                default => false,
            },
            self::STORED => match ($new) {
                self::RETURNED => true,
                default => false,
            },
            self::PENDING => true,
            self::RETURNED => false, default => false,
        };
    }

    /**
     * Whether the status can NOT be changed.
     *
     * @param  PurchaseOrderStatus|string  $old  old status of purchase order status
     * @param  PurchaseOrderStatus  $new  new status of purchase order status
     * @return bool true if successful, false otherwise
     */
    public static function cannot(PurchaseOrderStatus|string $old, PurchaseOrderStatus $new): bool
    {
        return self::can($old, $new) === false;
    }
}

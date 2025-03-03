<?php

namespace App\Enums;

use Cable8mm\EnumGetter\EnumGetter;

enum PurchaseOrderItemStatus: string
{
    use EnumGetter;

    case PENDING = 'Pending';
    case RECEIVED = 'Received';
    case INSPECTED = 'Inspected';
    case STORED = 'Stored';
    case DAMAGED = 'Damaged';
    case RETURNED = 'Returned';
    case CANCELED = 'Canceled';

    public function value(): string
    {
        return match ($this) {
            self::PENDING => __('enum.purchase-order-item-status.PENDING'),
            self::RECEIVED => __('enum.purchase-order-item-status.RECEIVED'),
            self::INSPECTED => __('enum.purchase-order-item-status.INSPECTED'),
            self::STORED => __('enum.purchase-order-item-status.STORED'),
            self::DAMAGED => __('enum.purchase-order-item-status.DAMAGED'),
            self::RETURNED => __('enum.purchase-order-item-status.RETURNED'),
            self::CANCELED => __('enum.purchase-order-item-status.CANCELED'),
        };
    }

    public static function loadingWhen(): array
    {
        return [self::PENDING, self::RECEIVED, self::INSPECTED];
    }

    public static function failedWhen(): array
    {
        return [self::DAMAGED, self::RETURNED, self::CANCELED];
    }

    /**
     * Whether the status can be changed.
     *
     * @param  PurchaseOrderItemStatus|string|null  $old  old status of purchase order item status
     * @param  PurchaseOrderItemStatus|string  $new  new status of purchase order item status
     * @return bool true if successful, false otherwise
     */
    public static function can(PurchaseOrderItemStatus|string|null $old, PurchaseOrderItemStatus|string $new): bool
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
            self::STORED => match ($new) {
                self::DAMAGED => true, self::RETURNED => true,
                default => false,
            },
            self::DAMAGED => match ($new) {
                self::RETURNED => true,
                default => false,
            },
            self::STORED => match ($new) {
                self::DAMAGED => true, self::RETURNED => true,
                default => false,
            },
            self::PENDING => true, self::RECEIVED => true, self::INSPECTED => true,
            self::RETURNED => false, default => false,
        };
    }

    /**
     * Whether the status can NOT be changed.
     *
     * @param  PurchaseOrderItemStatus|string|null  $old  old status of purchase order item status
     * @param  PurchaseOrderItemStatus|string  $new  new status of purchase order item status
     * @return bool true if successful, false otherwise
     */
    public static function cannot(PurchaseOrderItemStatus|string|null $old, PurchaseOrderItemStatus|string $new): bool
    {
        return self::can($old, $new) === false;
    }
}

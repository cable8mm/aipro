<?php

namespace App\Enums;

use Cable8mm\EnumGetter\EnumGetter;

enum PurchaseOrderItemStatus: string
{
    use EnumGetter;

    case PENDING = 'pending';
    case RECEIVED = 'received';
    case INSPECTED = 'inspected';
    case STORED = 'stored';
    case DAMAGED = 'damaged';
    case RETURNED = 'returned';
    case CANCELED = 'canceled';

    public function value(): string
    {
        return match ($this) {
            self::PENDING => __('purchases-order.pending'),
            self::RECEIVED => __('purchases-order.received'),
            self::INSPECTED => __('purchases-order.inspected'),
            self::STORED => __('purchases-order.stored'),
            self::DAMAGED => __('purchases-order.damaged'),
            self::RETURNED => __('purchases-order.returned'),
            self::CANCELED => __('purchases-order.canceled'),
        };
    }

    public static function loadingWhen(): array
    {
        return [self::PENDING->name, self::RECEIVED->name, self::INSPECTED->name];
    }

    public static function failedWhen(): array
    {
        return [self::DAMAGED->name, self::RETURNED->name, self::CANCELED->name];
    }

    public static function replicates(bool $default = false): array|string
    {
        return $default ? self::DAMAGED->name
            : [
                self::DAMAGED->name => self::DAMAGED->value(),
                self::RETURNED->name => self::RETURNED->value(),
            ];
    }

    /**
     * Whether the status can be changed.
     *
     * @param  PurchaseOrderItemStatus|string|null  $old  old status of purchase order item status
     * @param  PurchaseOrderItemStatus:string  $new  new status of purchase order item status
     * @return bool true if successful, false otherwise
     */
    public static function can(PurchaseOrderItemStatus|string|null $old, PurchaseOrderItemStatus|string $new): bool
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
     * @param  PurchaseOrderItemStatus|string  $old  old status of purchase order item status
     * @param  PurchaseOrderItemStatus  $new  new status of purchase order item status
     * @return bool true if successful, false otherwise
     */
    public static function cannot(PurchaseOrderItemStatus|string $old, PurchaseOrderItemStatus $new): bool
    {
        return self::can($old, $new) === false;
    }
}

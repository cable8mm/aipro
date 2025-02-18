<?php

namespace App\Enums;

use Cable8mm\EnumGetter\EnumGetter;

enum PlacingOrderItemStatus: string
{
    use EnumGetter;

    case NOT_IN_STOCK = 'not_in_stock';
    case DELETE = 'deleted';
    case IN_STOCK = 'in_stock';
    case BEING_IN_STOCK = 'being_in_stock';
    case CONFIRMING = 'confirming';

    public function value(): string
    {
        return match ($this) {
            self::NOT_IN_STOCK => '미입고',
            self::DELETE => '삭제',
            self::IN_STOCK => '입고완료',
            self::BEING_IN_STOCK => '입고중',
            self::CONFIRMING => '확인중',
        };
    }

    public static function loadingWhen(): array
    {
        return [self::NOT_IN_STOCK->name, self::BEING_IN_STOCK->name, self::CONFIRMING->name];
    }

    public static function failedWhen(): array
    {
        return [self::DELETE->name];
    }
}

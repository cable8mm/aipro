<?php

namespace App\Enums;

use Cable8mm\EnumGetter\EnumGetter;

enum PurchaseOrder: string
{
    use EnumGetter;

    case WRITING = 'writing';
    case CONFIRMING = 'confirming';
    case WAITING = 'waiting';
    case WAREHOUSED = 'warehoused';
    case DELETE = 'delete';

    public function value(): string
    {
        return match ($this) {
            self::WRITING => '발주서작성중',
            self::CONFIRMING => '공급사확인중',
            self::WAITING => '입고대기중',
            self::WAREHOUSED => '입고완료',
            self::DELETE => '삭제',
        };
    }

    public static function unfinishedWhen(): array
    {
        return [self::WRITING->name, self::CONFIRMING->name, self::WAITING->name];
    }

    public static function finishedWhen(): array
    {
        return [self::WAREHOUSED->name, self::DELETE->name];
    }

    public static function loadingWhen(): array
    {
        return [self::WAITING->name, self::CONFIRMING->name, self::WAITING->name];
    }

    public static function failedWhen(): array
    {
        return [self::DELETE->name];
    }
}

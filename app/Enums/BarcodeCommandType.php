<?php

namespace App\Enums;

use Cable8mm\EnumGetter\EnumGetter;

enum BarcodeCommandType: string
{
    use EnumGetter;

    case ORDER = '0';
    case ITEM = '8';
    case COMMAND = '9';

    public static function type(int $first): BarcodeCommandType
    {
        return match ($first) {
            self::ORDER => self::ORDER,
            self::COMMAND => self::COMMAND,
            default => self::ITEM,
        };
    }
}

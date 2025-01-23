<?php

namespace App\Enums;

use Cable8mm\EnumGetter\EnumGetter;

enum SafeClass: string
{
    use EnumGetter;

    case S1 = '1';
    case S2 = '2';
    case S3 = '3';
    case SX = 'X';

    public function value(): string
    {
        return match ($this) {
            self::S1 => __('Inventory Level 1'),
            self::S2 => __('Inventory Level 2'),
            self::S3 => __('Inventory Level 3'),
            self::SX => __('Inventory Level X'),
        };
    }
}

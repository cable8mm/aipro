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
            self::S1 => '1등급',
            self::S2 => '2등급',
            self::S3 => '3등급',
            self::SX => 'X등급',
        };
    }
}

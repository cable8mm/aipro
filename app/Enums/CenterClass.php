<?php

namespace App\Enums;

use Cable8mm\EnumGetter\EnumGetter;

enum CenterClass: string
{
    use EnumGetter;

    case M = 'M';
    case O = 'O';

    public function name(): string
    {
        return match ($this) {
            self::M => '센터 M등급',
            self::O => '센터 O등급',
        };
    }
}

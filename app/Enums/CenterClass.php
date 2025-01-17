<?php

namespace App\Enums;

use Cable8mm\EnumGetter\EnumGetter;

enum CenterClass: string
{
    use EnumGetter;

    case M = 'Center M Grade';
    case O = 'Center O Grade';

    public function value(): string
    {
        return match ($this) {
            self::M => '센터 M등급',    // My Center
            self::O => '센터 O등급',    // Other Center
        };
    }
}

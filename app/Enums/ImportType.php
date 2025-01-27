<?php

namespace App\Enums;

use Cable8mm\EnumGetter\EnumGetter;

enum ImportType: string
{
    use EnumGetter;

    case GOOD = 'good';

    public function value(): string
    {
        return match ($this) {
            self::GOOD => '상품',
        };
    }
}

<?php

namespace App\Enums;

use Cable8mm\EnumGetter\EnumGetter;

enum ItemInventoryLevel: string
{
    use EnumGetter;

    case LEVEL_1 = 'Level 1';
    case LEVEL_2 = 'Level 2';
    case LEVEL_3 = 'Level 3';
    case LEVEL_X = 'Level X';

    public function value(): string
    {
        return match ($this) {
            self::LEVEL_1 => __('enum.item-inventory-level.LEVEL_1'),
            self::LEVEL_2 => __('enum.item-inventory-level.LEVEL_2'),
            self::LEVEL_3 => __('enum.item-inventory-level.LEVEL_3'),
            self::LEVEL_X => __('enum.item-inventory-level.LEVEL_X'),
        };
    }
}

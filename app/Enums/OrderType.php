<?php

namespace App\Enums;

use Cable8mm\EnumGetter\EnumGetter;

enum OrderType: string
{
    use EnumGetter;

    case WAREHOUSE_A = 'Warehouse A';
    case WAREHOUSE_B = 'Warehouse B';
    case WAREHOUSE_C = 'Warehouse C';

    public function value(): string
    {
        return match ($this) {
            self::WAREHOUSE_A => __('Warehouse A'),
            self::WAREHOUSE_B => __('Warehouse B'),
            self::WAREHOUSE_C => __('Warehouse C'),
        };
    }
}

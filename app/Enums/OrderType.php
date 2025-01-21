<?php

namespace App\Enums;

use Cable8mm\EnumGetter\EnumGetter;

enum OrderType: string
{
    use EnumGetter;

    case J_CLASS = 'j class';
    case SINGLE = 'single';
    case MISMATCHED = 'mismatched';
    case FEEDSTUFF_BIG = 'feedstuff(big)';
    case FEEDSTUFF_MIDDLE = 'feedstuff(middle)';
    case FEEDSTUFF_SMALL = 'feedstuff(small)';
    case JIM_BALL = 'jim ball';
    case NONE = 'none';
    case PAD = 'pad';
    case PACKING_ZONE_A = 'picking zone A';
    case PACKING_ZONE_AB = 'picking zone AB';
    case PACKING_ZONE_B = 'picking zone B';

    public function value(): string
    {
        return match ($this) {
            self::J_CLASS => 'J등급상품',
            self::SINGLE => '단일상품',
            self::MISMATCHED => '미매칭',
            self::FEEDSTUFF_BIG => '사료(대)',
            self::FEEDSTUFF_MIDDLE => '사료(소)',
            self::FEEDSTUFF_SMALL => '사료(중)',
            self::JIM_BALL => '짐볼',
            self::NONE => '타입 없음',
            self::PAD => '패드',
            self::PACKING_ZONE_A => '피킹존 A',
            self::PACKING_ZONE_AB => '피킹존 AB',
            self::PACKING_ZONE_B => '피킹존 B',
        };
    }
}

<?php

namespace App\Enums;

use Cable8mm\EnumGetter\EnumGetter;

enum GoodColor: string
{
    use EnumGetter;

    case BLUE = 'blue';
    case RED = 'red';
    case GREEN = 'green';
    case YELLOW = 'yellow';
    case BLACK = 'black';
    case ORANGE = 'orange';

    public function name(): string
    {
        return match ($this) {
            self::BLUE => '파랑',
            self::RED => '빨강',
            self::GREEN => '초록',
            self::YELLOW => '노랑',
            self::BLACK => '검은색',
            self::ORANGE => '주황',
        };
    }
}

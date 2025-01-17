<?php

namespace App\Enums;

use Cable8mm\EnumGetter\EnumGetter;

enum UserType: string
{
    use EnumGetter;

    case ADMINISTRATOR = 'Administrator';
    case MANAGER = 'Manager';
    case MD = 'MD';
    case WAREHOUSER = 'Warehouser';
    case REVIEWER = 'Reviewer';

    public function value(): string
    {
        return match ($this) {
            self::ADMINISTRATOR => '최고관리자',
            self::MANAGER => '관리자',
            self::MD => '엠디',
            self::WAREHOUSER => '공무직',
            self::REVIEWER => '리뷰어',
        };
    }
}

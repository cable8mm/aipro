<?php

namespace App\Enums;

use Cable8mm\EnumGetter\EnumGetter;

enum UserType: string
{
    use EnumGetter;

    case ADMINISTRATOR = 'Administrator';
    case DEVELOPER = 'Developer';
    case MANAGER = 'Manager';
    case MD = 'MD';
    case WAREHOUSER = 'Warehouser';
    case REVIEWER = 'Reviewer';

    public function value(): string
    {
        return match ($this) {
            self::ADMINISTRATOR => __('enum.user-type.ADMINISTRATOR'),
            self::DEVELOPER => __('enum.user-type.DEVELOPER'),
            self::MANAGER => __('enum.user-type.MANAGER'),
            self::MD => __('enum.user-type.MD'),
            self::WAREHOUSER => __('enum.user-type.WAREHOUSER'),
            self::REVIEWER => __('enum.user-type.REVIEWER'),
        };
    }
}

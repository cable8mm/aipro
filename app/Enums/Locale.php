<?php

namespace App\Enums;

use Cable8mm\EnumGetter\EnumGetter;

enum Locale: string
{
    use EnumGetter;

    case KO = 'ko';
    case EN = 'en';

    public function value(): string
    {
        return match ($this) {
            self::KO => __('enum.locale.KO'),
            self::EN => __('enum.locale.EN'),
        };
    }

    public function ietf(): string
    {
        return match ($this) {
            self::KO => 'ko-KR',
            self::EN => 'en-US',
        };
    }

    public static function enValues(): array
    {
        return [
            self::EN->value => 'English',
            self::KO->value => 'Korean',
        ];
    }
}

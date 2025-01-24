<?php

namespace App\Enums;

use Cable8mm\EnumGetter\EnumGetter;

enum Channel: string
{
    use EnumGetter;

    case UPLOAD_COMPLETED = 'upload completed';
    case ON_SELLING = 'on selling';
    case FAILED = 'failed';

    public function value(): string
    {
        return match ($this) {
            self::UPLOAD_COMPLETED => '업로드완료',
            self::ON_SELLING => '판매중',
        };
    }

    public static function loadingWhen(): array
    {
        return [self::ON_SELLING->name];
    }

    public static function failedWhen(): array
    {
        return [self::FAILED->name];
    }
}

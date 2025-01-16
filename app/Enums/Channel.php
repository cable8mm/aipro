<?php

namespace App\Enums;

use Cable8mm\EnumGetter\EnumGetter;

enum Channel: string
{
    use EnumGetter;

    case UPLOAD_COMPLETED = 'upload completed';
    case ON_SELLING = 'on selling';

    public function value(): string
    {
        return match ($this) {
            self::UPLOAD_COMPLETED => '업로드완료',
            self::ON_SELLING => '판매중',
        };
    }
}

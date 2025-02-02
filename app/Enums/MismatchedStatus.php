<?php

namespace App\Enums;

use Cable8mm\EnumGetter\EnumGetter;

enum MismatchedStatus: string
{
    use EnumGetter;

    case READY = 'ready';
    case FAILED = 'failed';
    case COMPLETED = 'completed';

    public function value(): string
    {
        return match ($this) {
            self::READY => '미처리',
            self::FAILED => '실패',
            self::COMPLETED => '처리완료',
        };
    }

    public static function loadingWhen(): array
    {
        return [self::READY->name];
    }

    public static function failedWhen(): array
    {
        return [self::FAILED->name];
    }
}

<?php

namespace App\Enums;

use Cable8mm\EnumGetter\EnumGetter;

enum MismatchedStatus: string
{
    use EnumGetter;

    case READY = 'Ready';
    case FAILED = 'Failed';
    case COMPLETED = 'Completed';

    public function value(): string
    {
        return match ($this) {
            self::READY => __('enum.mismatched-status.READY'),
            self::FAILED => __('enum.mismatched-status.FAILED'),
            self::COMPLETED => __('enum.mismatched-status.COMPLETED'),
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

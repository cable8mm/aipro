<?php

namespace App\Enums;

use Cable8mm\EnumGetter\EnumGetter;

enum Status: string
{
    use EnumGetter;

    case WAITING = 'waiting';
    case RUNNING = 'running';
    case FAILED = 'failed';
    case SUCCESS = 'success';

    public function value(): string
    {
        return match ($this) {
            self::WAITING => '대기',
            self::RUNNING => '작업중',
            self::FAILED => '실패',
            self::SUCCESS => '성공',
        };
    }

    public static function loadingWhen(): array
    {
        return [self::WAITING->value(), self::RUNNING->value()];
    }

    public static function failedWhen(): array
    {
        return [self::FAILED->value()];
    }
}

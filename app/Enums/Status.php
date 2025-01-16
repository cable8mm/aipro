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

    public function name(): string
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
        return [self::WAITING->name(), self::RUNNING->name()];
    }

    public static function failedWhen(): array
    {
        return [self::FAILED->name()];
    }
}

<?php

namespace App\Enums;

use Cable8mm\EnumGetter\EnumGetter;

enum Status: string
{
    use EnumGetter;

    case WAITING = 'Waiting';
    case RUNNING = 'Running';
    case FAILED = 'Failed';
    case SUCCESS = 'Success';

    public function value(): string
    {
        return match ($this) {
            self::WAITING => __('enum.status.WAITING'),
            self::RUNNING => __('enum.status.RUNNING'),
            self::FAILED => __('enum.status.FAILED'),
            self::SUCCESS => __('enum.status.SUCCESS'),
        };
    }

    public static function loadingWhen(): array
    {
        return [self::WAITING->name, self::RUNNING->name];
    }

    public static function failedWhen(): array
    {
        return [self::FAILED->name];
    }
}

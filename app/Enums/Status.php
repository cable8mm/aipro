<?php

namespace App\Enums;

enum Status: string
{
    case WAITING = 'waiting';
    case RUNNING = 'running';
    case FAILED = 'failed';
    case SUCCESS = 'success';

    public function name(): string
    {
        return match ($this) {
            self::WAITING => __('waiting'),
            self::RUNNING => __('running'),
            self::FAILED => __('failed'),
            self::SUCCESS => __('success'),
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

    public static function toKeys(): array
    {
        $result = [];

        foreach (self::cases() as $value) {
            $result[$value->name()] = $value->value;
        }

        return $result;
    }

    public static function toArray(): array
    {
        $result = [];

        foreach (self::cases() as $value) {
            $result[$value->value] = $value->name();
        }

        return $result;
    }
}

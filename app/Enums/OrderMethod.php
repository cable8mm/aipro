<?php

namespace App\Enums;

enum OrderMethod: string
{
    case SMS = 'sms';
    case EMAIL = 'email';
    case PHONE = 'phone';
    case KAKAOTALK = 'kakaotalk';
    case ORDER_SYSTEM = 'order_system';

    public function name(): string
    {
        return match ($this) {
            self::SMS => '문자 메시지',
            self::EMAIL => '이메일',
            self::PHONE => '전화',
            self::KAKAOTALK => '카카오톡',
            self::ORDER_SYSTEM => '발주 시스템',
        };
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

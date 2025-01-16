<?php

namespace App\Enums;

use Cable8mm\EnumGetter\EnumGetter;

enum OrderMethod: string
{
    use EnumGetter;

    case SMS = 'sms';
    case EMAIL = 'email';
    case PHONE = 'phone';
    case KAKAOTALK = 'kakaotalk';
    case ORDER_SYSTEM = 'order_system';

    public function value(): string
    {
        return match ($this) {
            self::SMS => '문자 메시지',
            self::EMAIL => '이메일',
            self::PHONE => '전화',
            self::KAKAOTALK => '카카오톡',
            self::ORDER_SYSTEM => '발주 시스템',
        };
    }
}

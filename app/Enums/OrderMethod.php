<?php

namespace App\Enums;

use Cable8mm\EnumGetter\EnumGetter;

enum OrderMethod: string
{
    use EnumGetter;

    case SMS = 'SMS';
    case EMAIL = 'Email';
    case PHONE = 'Phone';
    case KAKAOTALK = 'KakaoTalk';
    case ORDER_SYSTEM = 'Order System';

    public function value(): string
    {
        return match ($this) {
            self::SMS => __('enum.order-method.SMS'),
            self::EMAIL => __('enum.order-method.EMAIL'),
            self::PHONE => __('enum.order-method.PHONE'),
            self::KAKAOTALK => __('enum.order-method.KAKAOTALK'),
            self::ORDER_SYSTEM => __('enum.order-method.ORDER_SYSTEM'),
        };
    }
}

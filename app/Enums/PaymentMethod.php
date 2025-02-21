<?php

namespace App\Enums;

use Cable8mm\EnumGetter\EnumGetter;

enum PaymentMethod: string
{
    use EnumGetter;

    case CASH = 'cash';
    case CARD = 'card';
    case MOBILE = 'mobile';
    case OTHER = 'other';

    public function value(): string
    {
        return match ($this) {
            self::CASH => '💰 '.__('Cash'),
            self::CARD => '💳 '.__('Card'),
            self::MOBILE => '📱 '.__('Mobile'),
            self::OTHER => '🧾 '.__('Other'),
        };
    }
}

<?php

namespace App\Enums;

use Cable8mm\EnumGetter\EnumGetter;

enum PaymentMethod: string
{
    use EnumGetter;

    case CASH = 'Cash';
    case CARD = 'Card';
    case MOBILE = 'Mobile';
    case OTHER = 'Other';

    public function value(): string
    {
        return match ($this) {
            self::CASH => '💰 '.__('enum.payment-method.CASH'),
            self::CARD => '💳 '.__('enum.payment-method.CARD'),
            self::MOBILE => '📱 '.__('enum.payment-method.MOBILE'),
            self::OTHER => '🧾 '.__('enum.payment-method.OTHER'),
        };
    }
}

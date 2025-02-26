<?php

namespace App\Enums;

use Cable8mm\EnumGetter\EnumGetter;

enum SupplierPricingPolicy: string
{
    use EnumGetter;

    case FLEXIBLE = 'Flexible';
    case GUIDED = 'Guided';
    case FIXED = 'Fixed';

    public function value(): string
    {
        return match ($this) {
            self::FLEXIBLE => '🔄 '.__('enum.supplier-pricing-policy.FLEXIBLE'),
            self::GUIDED => '📏 '.__('enum.supplier-pricing-policy.GUIDED'),
            self::FIXED => '🔒 '.__('enum.supplier-pricing-policy.FIXED'),
        };
    }
}

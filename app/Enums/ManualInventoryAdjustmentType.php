<?php

namespace App\Enums;

use Cable8mm\EnumGetter\EnumGetter;

enum ManualInventoryAdjustmentType: string
{
    use EnumGetter;

    case CLIENT_RETURN = 'client_return';
    case EXCHANGE = 'exchange';
    case WRONG_DELIVERY = 'wrong_delivery';
    case CHECK = 'check';
    case SUPPLIER_RETURN = 'supplier_return';
    case DISPOSAL = 'disposal';
    case MISTAKE = 'mistake';

    public function name(): string
    {
        return match ($this) {
            self::CLIENT_RETURN => '고객반품',
            self::EXCHANGE => '고객교환',
            self::WRONG_DELIVERY => '오배송교환',
            self::CHECK => '실사조정',
            self::SUPPLIER_RETURN => '공급사반품',
            self::DISPOSAL => '폐기',
            self::MISTAKE => '오기입',
        };
    }
}

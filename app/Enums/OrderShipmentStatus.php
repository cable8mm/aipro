<?php

namespace App\Enums;

use Cable8mm\EnumGetter\EnumGetter;

enum OrderShipmentStatus: string
{
    use EnumGetter;

    case 송장입력 = '송장입력';
    case 상품준비중 = '상품준비중';
    case 검수완료 = '검수완료';
    case 에러 = '에러';

    public static function loadingWhen(): array
    {
        return [self::송장입력->name, self::상품준비중->name];
    }

    public static function failedWhen(): array
    {
        return [self::에러->name];
    }
}

<?php

namespace App\Enums;

use Cable8mm\EnumGetter\EnumGetter;

enum Site: string
{
    use EnumGetter;

    case STREET11 = '11번가';
    case SMART_STORE = '스마트스토어';
    case LOTTE_DEPARTURE = '롯데백화점';
    case WEMAKE2 = '위메프2.0';
    case KAKAOTALK_GIFT = '카카오톡선물하기';
    case GODO5 = '고도몰5';
    case G_MARKET = 'G마켓';
    case CAFE24_NEW = '카페24(신)';
    case TIMON = '티몬';
    case SSG = 'SSG(통합)';
    case LOTTE_I = '롯데아이몰';
    case K1300 = '1300K';
    case HMALL = '현대H몰';
    case NSMALL = '농수산쇼핑몰(신)';
    case AUCTION = '옥션';
    case INTERPARK = '인터파크-오픈마켓';
    case GSESHOP = 'GS이숍';

    public function value(): string
    {
        return match ($this) {
            self::STREET11 => '11번가',
            self::SMART_STORE => '스마트스토어',
            self::LOTTE_DEPARTURE => '롯데백화점',
            self::WEMAKE2 => '위메프2.0',
            self::KAKAOTALK_GIFT => '카카오톡선물하기',
            self::GODO5 => '고도몰5',
            self::G_MARKET => 'G마켓',
            self::CAFE24_NEW => '카페24(신)',
            self::TIMON => '티몬',
            self::SSG => 'SSG(통합)',
            self::LOTTE_I => '롯데아이몰',
            self::K1300 => '1300K',
            self::HMALL => '현대H몰',
            self::NSMALL => '농수산쇼핑몰(신)',
            self::AUCTION => '옥션',
            self::INTERPARK => '인터파크-오픈마켓',
            self::GSESHOP => 'GS이숍'
        };
    }
}

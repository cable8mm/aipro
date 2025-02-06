<?php

namespace App\Enums;

use Picqer\Barcode\Types\TypeCodabar;
use Picqer\Barcode\Types\TypeCode128;
use Picqer\Barcode\Types\TypeEan13;
use Picqer\Barcode\Types\TypeInterface;
use Picqer\Barcode\Types\TypeITF14;

enum BarcodeType: string
{
    case ITF14 = 'itf14';
    case EAN13 = 'ean13';
    case CODE128 = 'code128';
    case CODABAR = 'codabar';

    public static function barcodeGenerator(BarcodeType $type): TypeInterface
    {
        switch ($type) {
            case self::ITF14:
                return new TypeITF14;
            case self::EAN13:
                return new TypeEan13;
            case self::CODE128:
                return new TypeCode128;
            case self::CODABAR:
                return new TypeCodabar;
            default:
                throw new \InvalidArgumentException('Unsupported barcode type');
        }
    }
}

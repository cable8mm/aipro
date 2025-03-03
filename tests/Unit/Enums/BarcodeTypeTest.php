<?php

namespace Tests\Unit\Enums;

use App\Enums\BarcodeType;
use PHPUnit\Framework\TestCase;
use Picqer\Barcode\Types\TypeCodabar;
use Picqer\Barcode\Types\TypeCode128;
use Picqer\Barcode\Types\TypeEan13;
use Picqer\Barcode\Types\TypeITF14;

class BarcodeTypeTest extends TestCase
{
    public function test_barcode_generator_method(): void
    {
        $this->assertEquals(new TypeITF14, BarcodeType::barcodeGenerator(BarcodeType::ITF14));
        $this->assertEquals(new TypeEan13, BarcodeType::barcodeGenerator(BarcodeType::EAN13));
        $this->assertEquals(new TypeCode128, BarcodeType::barcodeGenerator(BarcodeType::CODE128));
        $this->assertEquals(new TypeCodabar, BarcodeType::barcodeGenerator(BarcodeType::CODABAR));
    }
}

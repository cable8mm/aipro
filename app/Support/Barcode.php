<?php

namespace App\Support;

use App\Enums\BarcodeCommandType;
use App\Enums\BarcodeType;

/**
 * Generate and render a various barcode.
 *
 * @author Samgu Lee <cable8mm@gmail.com>
 *
 * @example Barcode::factory('80000001000019')->render();
 *
 * @created_at 2025-01-19
 */
final class Barcode
{
    /**
     * Barcode number with check digit
     */
    private string $originalNumber;

    /**
     * Barcode number without check digit
     */
    public string $number;

    /**
     * Barcode type
     *
     * @example BarcodeType::ITF14, BarcodeType::EAN13, BarcodeType::CODE128, BarcodeType::CODE39
     */
    public BarcodeType $type;

    public BarcodeCommandType $commandType;

    public function __construct(
        string $originalNumber
    ) {
        $this->originalNumber = $originalNumber;

        [$this->commandType, $this->number, $this->type] = $this->getProperties($originalNumber);
    }

    private function getProperties(string $number): array
    {
        $barcodeCommandTypeValue = $number[0];

        if (null == ($barcodeCommandType = BarcodeCommandType::getName($barcodeCommandTypeValue))) {
            throw new \Exception($barcodeCommandTypeValue.' is invalid barcode command type');
        }

        $barcodeType = '';

        if (strlen($number) === 14) {
            $number = substr($number, 0, 13);

            $barcodeType = BarcodeType::ITF14;
        } elseif (strlen($number) === 13) {
            $number = substr($number, 0, 12);

            $barcodeType = BarcodeType::EAN13;
        } elseif (preg_match('/[^0-9]/i', $number)) {
            $number = $barcodeCommandTypeValue.'00'.str_pad($number, 10, '0', STR_PAD_LEFT);

            $barcodeType = BarcodeType::CODE128;
        } else {
            assert(false, 'Invalid code');
        }

        return [BarcodeCommandType::{$barcodeCommandType}, $number, $barcodeType];
    }

    public function render()
    {
        $barcode = BarcodeType::barcodeGenerator($this->type)->getBarcode($this->number);

        $renderer = new \Picqer\Barcode\Renderers\PngRenderer;

        return $renderer->render($barcode, width: 155, height: 50);
    }

    public static function factory(
        string $code
    ): self {
        return new self($code);
    }
}

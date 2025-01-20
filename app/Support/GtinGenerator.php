<?php

namespace App\Support;

/**
 * Gtin barcode number generator class
 */
class GtinGenerator
{
    /**
     * GTIN barcode number length
     */
    const LENGTH = 13;

    /**
     * GTIN barcode number prefix for box barcode
     */
    const BOX_PREFIX = '90000002';

    /**
     * GTIN barcode number prefix for command barcode
     */
    const COMMAND_PREFIX = '90000001';

    /**
     * Get command barcode number
     *
     * @param  int  $id  `barcode_commands` table id
     */
    public function getCommand(int $id): string
    {
        $idLength = static::LENGTH - strlen(static::COMMAND_PREFIX);

        $code = static::COMMAND_PREFIX.sprintf('%0'.$idLength.'d', $id);

        return $this->get($code);
    }

    /**
     * Get box barcode number
     *
     * @param  int  $id  `boxes` table id
     */
    public function getBox(int $id): string
    {
        $idLength = static::LENGTH - strlen(static::BOX_PREFIX);

        $code = static::BOX_PREFIX.sprintf('%0'.$idLength.'d', $id);

        return $this->get($code);
    }

    /**
     * Get barcode with checksum
     *
     * @param  string  $code  Barcode number
     * @return string The method returns the barcode number with checksum
     */
    public function get(string $code): string
    {
        return $code.$this->getChecksum($code);
    }

    /**
     * Get check sum for barcode calculation
     *
     * @see https://www.phpclasses.org/package/8560-PHP-Detect-type-and-check-EAN-and-UPC-barcodes.html
     */
    private function getChecksum(string $code): string
    {
        $iCalculation = 0;
        for ($i = 0; $i < (strlen($code)); $i++) {
            $iCalculation += $i % 2 ? $code[$i] * 1 : $code[$i] * 3;
        }

        return substr(10 - (substr($iCalculation, -1)), -1);
    }

    /**
     * Factory method to create
     *
     * @param  string  $id  `boxes` table id
     * @return string This method returns box barcode number
     */
    public static function ofBox(string $id): string
    {
        return (new static)->getBox($id);
    }
}

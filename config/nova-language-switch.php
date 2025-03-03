<?php

/**
 * @author BadinanSoft
 * @license MIT
 *
 * @link https://badinansoft.com
 */

use App\Enums\Locale;

return [

    /**
     * List of languages that your application supports
     * array <string, string>
     */
    'supported-languages' => Locale::enValues(),

    /**
     * Languages That need RTL support
     * string
     */
    'rtl-languages' => [],

];

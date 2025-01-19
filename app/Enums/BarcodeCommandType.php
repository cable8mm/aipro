<?php

namespace App\Enums;

use Cable8mm\EnumGetter\EnumGetter;

enum BarcodeCommandType: string
{
    use EnumGetter;

    case ORDER = '0';
    case GOOD = '8';
    case COMMAND = '9';
}

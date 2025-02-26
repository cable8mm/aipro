<?php

namespace App\Enums;

use Cable8mm\EnumGetter\EnumGetter;

enum OrderSheetWaybillStatus: string
{
    use EnumGetter;

    case FILE_UPLOADED = 'File Uploaded';
    case FILE_ON_SUCCESS = 'File On Success';
    case RUNNING = 'Running';
    case SUCCESS = 'Success';
    case CANCEL = 'Cancel';
    case ERROR = 'Error';

    public function value(): string
    {
        return match ($this) {
            self::FILE_UPLOADED => __('enum.order-sheet-waybill-status.FILE_UPLOADED'),
            self::FILE_ON_SUCCESS => __('enum.order-sheet-waybill-status.FILE_ON_SUCCESS'),
            self::RUNNING => __('enum.order-sheet-waybill-status.RUNNING'),
            self::SUCCESS => __('enum.order-sheet-waybill-status.SUCCESS'),
            self::CANCEL => __('enum.order-sheet-waybill-status.CANCEL'),
            self::ERROR => __('enum.order-sheet-waybill-status.ERROR'),
        };
    }

    public static function loadingWhen(): array
    {
        return [self::FILE_UPLOADED->name, self::FILE_ON_SUCCESS->name];
    }

    public static function failedWhen(): array
    {
        return [self::ERROR->name];
    }
}

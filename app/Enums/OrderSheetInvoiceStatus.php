<?php

namespace App\Enums;

use Cable8mm\EnumGetter\EnumGetter;

enum OrderSheetInvoiceStatus: string
{
    use EnumGetter;

    case FILE_UPLOADED = 'file uploaded';
    case FILE_ON_SUCCESS = 'file on success';
    case RUNNING = 'running';
    case SUCCESS = 'success';
    case CANCEL = 'cancel';
    case ERROR = 'error';

    public function value(): string
    {
        return match ($this) {
            self::FILE_UPLOADED => '파일업로드',
            self::FILE_ON_SUCCESS => '정상확인완료',
            self::RUNNING => '작업중',
            self::SUCCESS => '주문서입력완료',
            self::CANCEL => '취소',
            self::ERROR => '에러',
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

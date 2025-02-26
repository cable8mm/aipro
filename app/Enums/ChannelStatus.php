<?php

namespace App\Enums;

use Cable8mm\EnumGetter\EnumGetter;

enum ChannelStatus: string
{
    use EnumGetter;

    case UPLOAD_COMPLETED = 'Upload Completed';
    case ON_SELLING = 'On Selling';
    case FAILED = 'Failed';

    public function value(): string
    {
        return match ($this) {
            self::UPLOAD_COMPLETED => '업로드완료',
            self::ON_SELLING => '판매중',
            self::FAILED => '실패',
        };
    }

    public static function loadingWhen(): array
    {
        return [self::ON_SELLING->name];
    }

    public static function failedWhen(): array
    {
        return [self::FAILED->name];
    }
}

<?php

namespace Tests\Unit\Enums;

use App\Enums\Locale;
use PHPUnit\Framework\TestCase;

class LocaleTest extends TestCase
{
    public function test_en_values_method(): void
    {
        $this->assertSame([
            'en' => 'English',
            'ko' => 'Korean',
        ], Locale::enValues());
    }

    public function test_ietf_method(): void
    {
        $this->assertSame('en-US', Locale::EN->ietf());
        $this->assertSame('ko-KR', Locale::KO->ietf());
    }

    public function test_ietfs_method(): void
    {
        $this->assertSame([
            'en' => 'en-US',
            'ko' => 'ko-KR',
        ], Locale::ietfs());
    }
}

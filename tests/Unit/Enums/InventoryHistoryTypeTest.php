<?php

namespace Tests\Unit\Enums;

use App\Enums\InventoryHistoryType;
use PHPUnit\Framework\TestCase;

class InventoryHistoryTypeTest extends TestCase
{
    public function test_of_method(): void
    {
        $this->assertSame(InventoryHistoryType::WAREHOUSING, InventoryHistoryType::of(1));

        $this->assertSame(InventoryHistoryType::SHIPPING, InventoryHistoryType::of(-1));

        $this->assertSame(InventoryHistoryType::SHIPPING_CANCELED, InventoryHistoryType::of(1, 1));

        $this->assertSame(InventoryHistoryType::WAREHOUSING_CANCELED, InventoryHistoryType::of(-1, 1));
    }

    public function test_loading_when_method(): void
    {
        $this->assertSame([], InventoryHistoryType::loadingWhen());
    }

    public function test_failed_when_method(): void
    {
        $this->assertSame([InventoryHistoryType::WAREHOUSING_CANCELED, InventoryHistoryType::SHIPPING_CANCELED], InventoryHistoryType::failedWhen());
    }
}

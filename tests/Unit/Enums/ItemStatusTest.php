<?php

namespace Tests\Unit\Enums;

use App\Enums\ItemStatus;
use PHPUnit\Framework\TestCase;

class ItemStatusTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_status_method(): void
    {
        $origins = [
            ItemStatus::PENDING,
            ItemStatus::ACTIVE,
            ItemStatus::DISCONTINUED,
            ItemStatus::OUT_OF_STOCK,
        ];

        foreach ($origins as $origin) {
            $this->assertSame($origin->status(), ItemStatus::PENDING);
        }
    }

    public function test_status_method_with_pending(): void
    {
        $this->assertSame(ItemStatus::PENDING, ItemStatus::PENDING->status());
        $this->assertSame(ItemStatus::PENDING, ItemStatus::PENDING->status(0));
        $this->assertSame(ItemStatus::ACTIVE, ItemStatus::PENDING->status(10));
        $this->assertSame(ItemStatus::DISCONTINUED, ItemStatus::PENDING->status(10, now()));
    }

    public function test_status_method_with_out_of_stock(): void
    {
        $this->assertSame(ItemStatus::OUT_OF_STOCK, ItemStatus::ACTIVE->status(0));
        $this->assertSame(ItemStatus::DISCONTINUED, ItemStatus::DISCONTINUED->status(0));
        $this->assertSame(ItemStatus::OUT_OF_STOCK, ItemStatus::OUT_OF_STOCK->status(0));
        $this->assertSame(ItemStatus::PENDING, ItemStatus::PENDING->status(0));
    }

    public function test_status_method_with_active(): void
    {
        $this->assertSame(ItemStatus::ACTIVE, ItemStatus::ACTIVE->status(10));
        $this->assertSame(ItemStatus::DISCONTINUED, ItemStatus::DISCONTINUED->status(10));
        $this->assertSame(ItemStatus::ACTIVE, ItemStatus::OUT_OF_STOCK->status(10));
        $this->assertSame(ItemStatus::ACTIVE, ItemStatus::PENDING->status(10));
    }

    public function test_status_method_with_discontinued(): void
    {
        $this->assertSame(ItemStatus::DISCONTINUED, ItemStatus::ACTIVE->status(10, now()));
        $this->assertSame(ItemStatus::DISCONTINUED, ItemStatus::DISCONTINUED->status(10));
        $this->assertSame(ItemStatus::DISCONTINUED, ItemStatus::OUT_OF_STOCK->status(10, now()));
        $this->assertSame(ItemStatus::DISCONTINUED, ItemStatus::PENDING->status(10, now()));
    }
}

<?php

namespace Tests\Unit\Enums;

use App\Enums\PurchaseOrderStatus;
use PHPUnit\Framework\TestCase;

class PurchaseOrderStatusTest extends TestCase
{
    public function test_can_method(): void
    {
        $this->assertTrue(PurchaseOrderStatus::can(null, 'Pending'));

        $this->assertTrue(PurchaseOrderStatus::can('Pending', 'Stored'));
        $this->assertTrue(PurchaseOrderStatus::can('Pending', 'Returned'));

        $this->assertFalse(PurchaseOrderStatus::can('Stored', 'Pending'));
        $this->assertTrue(PurchaseOrderStatus::can('Stored', 'Returned'));

        $this->assertFalse(PurchaseOrderStatus::can('Returned', 'Pending'));
        $this->assertFalse(PurchaseOrderStatus::can('Returned', 'Stored'));
    }

    public function test_cannot_method(): void
    {
        $this->assertFalse(PurchaseOrderStatus::cannot(null, 'Pending'));

        $this->assertFalse(PurchaseOrderStatus::cannot('Pending', 'Stored'));
        $this->assertFalse(PurchaseOrderStatus::cannot('Pending', 'Returned'));

        $this->assertTrue(PurchaseOrderStatus::cannot('Stored', 'Pending'));
        $this->assertFalse(PurchaseOrderStatus::cannot('Stored', 'Returned'));

        $this->assertTrue(PurchaseOrderStatus::cannot('Returned', 'Pending'));
        $this->assertTrue(PurchaseOrderStatus::cannot('Returned', 'Stored'));
    }

    public function test_can_method_with_instance(): void
    {
        $this->assertTrue(PurchaseOrderStatus::can(null, PurchaseOrderStatus::PENDING));

        $this->assertTrue(PurchaseOrderStatus::can(PurchaseOrderStatus::PENDING, PurchaseOrderStatus::STORED));
        $this->assertTrue(PurchaseOrderStatus::can(PurchaseOrderStatus::PENDING, PurchaseOrderStatus::RETURNED));

        $this->assertFalse(PurchaseOrderStatus::can(PurchaseOrderStatus::STORED, PurchaseOrderStatus::PENDING));
        $this->assertTrue(PurchaseOrderStatus::can(PurchaseOrderStatus::STORED, PurchaseOrderStatus::RETURNED));

        $this->assertFalse(PurchaseOrderStatus::can(PurchaseOrderStatus::RETURNED, PurchaseOrderStatus::PENDING));
        $this->assertFalse(PurchaseOrderStatus::can(PurchaseOrderStatus::RETURNED, PurchaseOrderStatus::STORED));
    }

    public function test_cannot_method_with_instance(): void
    {
        $this->assertFalse(PurchaseOrderStatus::cannot(null, PurchaseOrderStatus::PENDING));

        $this->assertFalse(PurchaseOrderStatus::cannot(PurchaseOrderStatus::PENDING, PurchaseOrderStatus::STORED));
        $this->assertFalse(PurchaseOrderStatus::cannot(PurchaseOrderStatus::PENDING, PurchaseOrderStatus::RETURNED));

        $this->assertTrue(PurchaseOrderStatus::cannot(PurchaseOrderStatus::STORED, PurchaseOrderStatus::PENDING));
        $this->assertFalse(PurchaseOrderStatus::cannot(PurchaseOrderStatus::STORED, PurchaseOrderStatus::RETURNED));

        $this->assertTrue(PurchaseOrderStatus::cannot(PurchaseOrderStatus::RETURNED, PurchaseOrderStatus::PENDING));
        $this->assertTrue(PurchaseOrderStatus::cannot(PurchaseOrderStatus::RETURNED, PurchaseOrderStatus::STORED));
    }
}

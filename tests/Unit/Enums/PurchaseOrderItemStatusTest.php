<?php

namespace Tests\Unit\Enums;

use App\Enums\PurchaseOrderItemStatus;
use PHPUnit\Framework\TestCase;

class PurchaseOrderItemStatusTest extends TestCase
{
    public function test_can_method(): void
    {
        $this->assertTrue(PurchaseOrderItemStatus::can(null, 'Pending'));

        $this->assertTrue(PurchaseOrderItemStatus::can('Pending', 'Received'));
        $this->assertTrue(PurchaseOrderItemStatus::can('Pending', 'Stored'));
        $this->assertTrue(PurchaseOrderItemStatus::can('Pending', 'Damaged'));
        $this->assertTrue(PurchaseOrderItemStatus::can('Pending', 'Returned'));
        $this->assertTrue(PurchaseOrderItemStatus::can('Pending', 'Canceled'));

        $this->assertTrue(PurchaseOrderItemStatus::can('Received', 'Pending'));
        $this->assertTrue(PurchaseOrderItemStatus::can('Received', 'Stored'));
        $this->assertTrue(PurchaseOrderItemStatus::can('Received', 'Damaged'));
        $this->assertTrue(PurchaseOrderItemStatus::can('Received', 'Returned'));
        $this->assertTrue(PurchaseOrderItemStatus::can('Received', 'Canceled'));

        $this->assertFalse(PurchaseOrderItemStatus::can('Damaged', 'Pending'));
        $this->assertFalse(PurchaseOrderItemStatus::can('Damaged', 'Received'));
        $this->assertFalse(PurchaseOrderItemStatus::can('Damaged', 'Stored'));
        $this->assertTrue(PurchaseOrderItemStatus::can('Damaged', 'Returned'));
        $this->assertFalse(PurchaseOrderItemStatus::can('Damaged', 'Canceled'));

        $this->assertFalse(PurchaseOrderItemStatus::can('Returned', 'Pending'));
        $this->assertFalse(PurchaseOrderItemStatus::can('Returned', 'Received'));
        $this->assertFalse(PurchaseOrderItemStatus::can('Returned', 'Stored'));
        $this->assertFalse(PurchaseOrderItemStatus::can('Returned', 'Damaged'));
        $this->assertFalse(PurchaseOrderItemStatus::can('Returned', 'Canceled'));

        $this->assertFalse(PurchaseOrderItemStatus::can('Canceled', 'Pending'));
        $this->assertFalse(PurchaseOrderItemStatus::can('Canceled', 'Received'));
        $this->assertFalse(PurchaseOrderItemStatus::can('Canceled', 'Stored'));
        $this->assertFalse(PurchaseOrderItemStatus::can('Canceled', 'Damaged'));
        $this->assertFalse(PurchaseOrderItemStatus::can('Canceled', 'Returned'));
    }

    public function test_cannot_method(): void
    {
        $this->assertFalse(PurchaseOrderItemStatus::cannot(null, 'Pending'));

        $this->assertFalse(PurchaseOrderItemStatus::cannot('Pending', 'Received'));
        $this->assertFalse(PurchaseOrderItemStatus::cannot('Pending', 'Stored'));
        $this->assertFalse(PurchaseOrderItemStatus::cannot('Pending', 'Damaged'));
        $this->assertFalse(PurchaseOrderItemStatus::cannot('Pending', 'Returned'));
        $this->assertFalse(PurchaseOrderItemStatus::cannot('Pending', 'Canceled'));

        $this->assertFalse(PurchaseOrderItemStatus::cannot('Received', 'Pending'));
        $this->assertFalse(PurchaseOrderItemStatus::cannot('Received', 'Stored'));
        $this->assertFalse(PurchaseOrderItemStatus::cannot('Received', 'Damaged'));
        $this->assertFalse(PurchaseOrderItemStatus::cannot('Received', 'Returned'));
        $this->assertFalse(PurchaseOrderItemStatus::cannot('Received', 'Canceled'));

        $this->assertTrue(PurchaseOrderItemStatus::cannot('Damaged', 'Pending'));
        $this->assertTrue(PurchaseOrderItemStatus::cannot('Damaged', 'Received'));
        $this->assertTrue(PurchaseOrderItemStatus::cannot('Damaged', 'Stored'));
        $this->assertFalse(PurchaseOrderItemStatus::cannot('Damaged', 'Returned'));
        $this->assertTrue(PurchaseOrderItemStatus::cannot('Damaged', 'Canceled'));

        $this->assertTrue(PurchaseOrderItemStatus::cannot('Returned', 'Pending'));
        $this->assertTrue(PurchaseOrderItemStatus::cannot('Returned', 'Received'));
        $this->assertTrue(PurchaseOrderItemStatus::cannot('Returned', 'Stored'));
        $this->assertTrue(PurchaseOrderItemStatus::cannot('Returned', 'Damaged'));
        $this->assertTrue(PurchaseOrderItemStatus::cannot('Returned', 'Canceled'));

        $this->assertTrue(PurchaseOrderItemStatus::cannot('Canceled', 'Pending'));
        $this->assertTrue(PurchaseOrderItemStatus::cannot('Canceled', 'Received'));
        $this->assertTrue(PurchaseOrderItemStatus::cannot('Canceled', 'Stored'));
        $this->assertTrue(PurchaseOrderItemStatus::cannot('Canceled', 'Damaged'));
        $this->assertTrue(PurchaseOrderItemStatus::cannot('Canceled', 'Returned'));
    }

    public function test_can_method_with_instances(): void
    {
        $this->assertTrue(PurchaseOrderItemStatus::can(null, PurchaseOrderItemStatus::PENDING));

        $this->assertTrue(PurchaseOrderItemStatus::can(PurchaseOrderItemStatus::PENDING, PurchaseOrderItemStatus::RECEIVED));
        $this->assertTrue(PurchaseOrderItemStatus::can(PurchaseOrderItemStatus::PENDING, PurchaseOrderItemStatus::STORED));
        $this->assertTrue(PurchaseOrderItemStatus::can(PurchaseOrderItemStatus::PENDING, PurchaseOrderItemStatus::DAMAGED));
        $this->assertTrue(PurchaseOrderItemStatus::can(PurchaseOrderItemStatus::PENDING, PurchaseOrderItemStatus::RETURNED));
        $this->assertTrue(PurchaseOrderItemStatus::can(PurchaseOrderItemStatus::PENDING, PurchaseOrderItemStatus::CANCELED));

        $this->assertTrue(PurchaseOrderItemStatus::can(PurchaseOrderItemStatus::RECEIVED, PurchaseOrderItemStatus::PENDING));
        $this->assertTrue(PurchaseOrderItemStatus::can(PurchaseOrderItemStatus::RECEIVED, PurchaseOrderItemStatus::STORED));
        $this->assertTrue(PurchaseOrderItemStatus::can(PurchaseOrderItemStatus::RECEIVED, PurchaseOrderItemStatus::DAMAGED));
        $this->assertTrue(PurchaseOrderItemStatus::can(PurchaseOrderItemStatus::RECEIVED, PurchaseOrderItemStatus::RETURNED));
        $this->assertTrue(PurchaseOrderItemStatus::can(PurchaseOrderItemStatus::RECEIVED, PurchaseOrderItemStatus::CANCELED));

        $this->assertFalse(PurchaseOrderItemStatus::can(PurchaseOrderItemStatus::DAMAGED, PurchaseOrderItemStatus::PENDING));
        $this->assertFalse(PurchaseOrderItemStatus::can(PurchaseOrderItemStatus::DAMAGED, PurchaseOrderItemStatus::RECEIVED));
        $this->assertFalse(PurchaseOrderItemStatus::can(PurchaseOrderItemStatus::DAMAGED, PurchaseOrderItemStatus::STORED));
        $this->assertTrue(PurchaseOrderItemStatus::can(PurchaseOrderItemStatus::DAMAGED, PurchaseOrderItemStatus::RETURNED));
        $this->assertFalse(PurchaseOrderItemStatus::can(PurchaseOrderItemStatus::DAMAGED, PurchaseOrderItemStatus::CANCELED));

        $this->assertFalse(PurchaseOrderItemStatus::can(PurchaseOrderItemStatus::RETURNED, PurchaseOrderItemStatus::PENDING));
        $this->assertFalse(PurchaseOrderItemStatus::can(PurchaseOrderItemStatus::RETURNED, PurchaseOrderItemStatus::RECEIVED));
        $this->assertFalse(PurchaseOrderItemStatus::can(PurchaseOrderItemStatus::RETURNED, PurchaseOrderItemStatus::STORED));
        $this->assertFalse(PurchaseOrderItemStatus::can(PurchaseOrderItemStatus::RETURNED, PurchaseOrderItemStatus::DAMAGED));
        $this->assertFalse(PurchaseOrderItemStatus::can(PurchaseOrderItemStatus::RETURNED, PurchaseOrderItemStatus::CANCELED));

        $this->assertFalse(PurchaseOrderItemStatus::can(PurchaseOrderItemStatus::CANCELED, PurchaseOrderItemStatus::PENDING));
        $this->assertFalse(PurchaseOrderItemStatus::can(PurchaseOrderItemStatus::CANCELED, PurchaseOrderItemStatus::RECEIVED));
        $this->assertFalse(PurchaseOrderItemStatus::can(PurchaseOrderItemStatus::CANCELED, PurchaseOrderItemStatus::STORED));
        $this->assertFalse(PurchaseOrderItemStatus::can(PurchaseOrderItemStatus::CANCELED, PurchaseOrderItemStatus::DAMAGED));
        $this->assertFalse(PurchaseOrderItemStatus::can(PurchaseOrderItemStatus::CANCELED, PurchaseOrderItemStatus::RETURNED));
    }

    public function test_cannot_method_with_instances(): void
    {
        $this->assertFalse(PurchaseOrderItemStatus::cannot(null, PurchaseOrderItemStatus::PENDING));

        $this->assertFalse(PurchaseOrderItemStatus::cannot(PurchaseOrderItemStatus::PENDING, PurchaseOrderItemStatus::RECEIVED));
        $this->assertFalse(PurchaseOrderItemStatus::cannot(PurchaseOrderItemStatus::PENDING, PurchaseOrderItemStatus::STORED));
        $this->assertFalse(PurchaseOrderItemStatus::cannot(PurchaseOrderItemStatus::PENDING, PurchaseOrderItemStatus::DAMAGED));
        $this->assertFalse(PurchaseOrderItemStatus::cannot(PurchaseOrderItemStatus::PENDING, PurchaseOrderItemStatus::RETURNED));
        $this->assertFalse(PurchaseOrderItemStatus::cannot(PurchaseOrderItemStatus::PENDING, PurchaseOrderItemStatus::CANCELED));

        $this->assertFalse(PurchaseOrderItemStatus::cannot(PurchaseOrderItemStatus::RECEIVED, PurchaseOrderItemStatus::PENDING));
        $this->assertFalse(PurchaseOrderItemStatus::cannot(PurchaseOrderItemStatus::RECEIVED, PurchaseOrderItemStatus::STORED));
        $this->assertFalse(PurchaseOrderItemStatus::cannot(PurchaseOrderItemStatus::RECEIVED, PurchaseOrderItemStatus::DAMAGED));
        $this->assertFalse(PurchaseOrderItemStatus::cannot(PurchaseOrderItemStatus::RECEIVED, PurchaseOrderItemStatus::RETURNED));
        $this->assertFalse(PurchaseOrderItemStatus::cannot(PurchaseOrderItemStatus::RECEIVED, PurchaseOrderItemStatus::CANCELED));

        $this->assertTrue(PurchaseOrderItemStatus::cannot(PurchaseOrderItemStatus::DAMAGED, PurchaseOrderItemStatus::PENDING));
        $this->assertTrue(PurchaseOrderItemStatus::cannot(PurchaseOrderItemStatus::DAMAGED, PurchaseOrderItemStatus::RECEIVED));
        $this->assertTrue(PurchaseOrderItemStatus::cannot(PurchaseOrderItemStatus::DAMAGED, PurchaseOrderItemStatus::STORED));
        $this->assertFalse(PurchaseOrderItemStatus::cannot(PurchaseOrderItemStatus::DAMAGED, PurchaseOrderItemStatus::RETURNED));
        $this->assertTrue(PurchaseOrderItemStatus::cannot(PurchaseOrderItemStatus::DAMAGED, PurchaseOrderItemStatus::CANCELED));

        $this->assertTrue(PurchaseOrderItemStatus::cannot(PurchaseOrderItemStatus::RETURNED, PurchaseOrderItemStatus::PENDING));
        $this->assertTrue(PurchaseOrderItemStatus::cannot(PurchaseOrderItemStatus::RETURNED, PurchaseOrderItemStatus::RECEIVED));
        $this->assertTrue(PurchaseOrderItemStatus::cannot(PurchaseOrderItemStatus::RETURNED, PurchaseOrderItemStatus::STORED));
        $this->assertTrue(PurchaseOrderItemStatus::cannot(PurchaseOrderItemStatus::RETURNED, PurchaseOrderItemStatus::DAMAGED));
        $this->assertTrue(PurchaseOrderItemStatus::cannot(PurchaseOrderItemStatus::RETURNED, PurchaseOrderItemStatus::CANCELED));

        $this->assertTrue(PurchaseOrderItemStatus::cannot(PurchaseOrderItemStatus::CANCELED, PurchaseOrderItemStatus::PENDING));
        $this->assertTrue(PurchaseOrderItemStatus::cannot(PurchaseOrderItemStatus::CANCELED, PurchaseOrderItemStatus::RECEIVED));
        $this->assertTrue(PurchaseOrderItemStatus::cannot(PurchaseOrderItemStatus::CANCELED, PurchaseOrderItemStatus::STORED));
        $this->assertTrue(PurchaseOrderItemStatus::cannot(PurchaseOrderItemStatus::CANCELED, PurchaseOrderItemStatus::DAMAGED));
        $this->assertTrue(PurchaseOrderItemStatus::cannot(PurchaseOrderItemStatus::CANCELED, PurchaseOrderItemStatus::RETURNED));
    }
}

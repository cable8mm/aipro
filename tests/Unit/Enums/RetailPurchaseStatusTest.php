<?php

namespace Tests\Unit\Enums;

use App\Enums\RetailPurchaseStatus;
use PHPUnit\Framework\TestCase;

class RetailPurchaseStatusTest extends TestCase
{
    public function test_can_method(): void
    {
        $this->assertTrue(RetailPurchaseStatus::can(null, 'Pending'));

        $this->assertTrue(RetailPurchaseStatus::can('Pending', 'Completed'));
        $this->assertTrue(RetailPurchaseStatus::can('Pending', 'Canceled'));
        $this->assertTrue(RetailPurchaseStatus::can('Pending', 'Refunded'));

        $this->assertFalse(RetailPurchaseStatus::can('Completed', 'Pending'));
        $this->assertFalse(RetailPurchaseStatus::can('Completed', 'Canceled'));
        $this->assertTrue(RetailPurchaseStatus::can('Completed', 'Refunded'));

        $this->assertFalse(RetailPurchaseStatus::can('Canceled', 'Pending'));
        $this->assertFalse(RetailPurchaseStatus::can('Canceled', 'Completed'));
        $this->assertFalse(RetailPurchaseStatus::can('Canceled', 'Refunded'));

        $this->assertFalse(RetailPurchaseStatus::can('Refunded', 'Pending'));
        $this->assertFalse(RetailPurchaseStatus::can('Refunded', 'Completed'));
        $this->assertFalse(RetailPurchaseStatus::can('Refunded', 'Canceled'));
    }

    public function test_cannot_method(): void
    {
        $this->assertFalse(RetailPurchaseStatus::cannot(null, 'Pending'));

        $this->assertFalse(RetailPurchaseStatus::cannot('Pending', 'Completed'));
        $this->assertFalse(RetailPurchaseStatus::cannot('Pending', 'Canceled'));
        $this->assertFalse(RetailPurchaseStatus::cannot('Pending', 'Refunded'));

        $this->assertTrue(RetailPurchaseStatus::cannot('Completed', 'Pending'));
        $this->assertTrue(RetailPurchaseStatus::cannot('Completed', 'Canceled'));
        $this->assertFalse(RetailPurchaseStatus::cannot('Completed', 'Refunded'));

        $this->assertTrue(RetailPurchaseStatus::cannot('Canceled', 'Pending'));
        $this->assertTrue(RetailPurchaseStatus::cannot('Canceled', 'Completed'));
        $this->assertTrue(RetailPurchaseStatus::cannot('Canceled', 'Refunded'));

        $this->assertTrue(RetailPurchaseStatus::cannot('Refunded', 'Pending'));
        $this->assertTrue(RetailPurchaseStatus::cannot('Refunded', 'Completed'));
        $this->assertTrue(RetailPurchaseStatus::cannot('Refunded', 'Canceled'));
    }

    public function test_can_method_with_instance(): void
    {
        $this->assertTrue(RetailPurchaseStatus::can(null, RetailPurchaseStatus::PENDING));

        $this->assertTrue(RetailPurchaseStatus::can(RetailPurchaseStatus::PENDING, RetailPurchaseStatus::COMPLETED));
        $this->assertTrue(RetailPurchaseStatus::can(RetailPurchaseStatus::PENDING, RetailPurchaseStatus::CANCELED));
        $this->assertTrue(RetailPurchaseStatus::can(RetailPurchaseStatus::PENDING, RetailPurchaseStatus::REFUNDED));

        $this->assertFalse(RetailPurchaseStatus::can(RetailPurchaseStatus::COMPLETED, RetailPurchaseStatus::PENDING));
        $this->assertFalse(RetailPurchaseStatus::can(RetailPurchaseStatus::COMPLETED, RetailPurchaseStatus::CANCELED));
        $this->assertTrue(RetailPurchaseStatus::can(RetailPurchaseStatus::COMPLETED, RetailPurchaseStatus::REFUNDED));

        $this->assertFalse(RetailPurchaseStatus::can(RetailPurchaseStatus::CANCELED, RetailPurchaseStatus::PENDING));
        $this->assertFalse(RetailPurchaseStatus::can(RetailPurchaseStatus::CANCELED, RetailPurchaseStatus::COMPLETED));
        $this->assertFalse(RetailPurchaseStatus::can(RetailPurchaseStatus::CANCELED, RetailPurchaseStatus::REFUNDED));

        $this->assertFalse(RetailPurchaseStatus::can(RetailPurchaseStatus::REFUNDED, RetailPurchaseStatus::PENDING));
        $this->assertFalse(RetailPurchaseStatus::can(RetailPurchaseStatus::REFUNDED, RetailPurchaseStatus::COMPLETED));
        $this->assertFalse(RetailPurchaseStatus::can(RetailPurchaseStatus::REFUNDED, RetailPurchaseStatus::CANCELED));
    }

    public function test_cannot_method_with_instance(): void
    {
        $this->assertFalse(RetailPurchaseStatus::cannot(null, RetailPurchaseStatus::PENDING));

        $this->assertFalse(RetailPurchaseStatus::cannot(RetailPurchaseStatus::PENDING, RetailPurchaseStatus::COMPLETED));
        $this->assertFalse(RetailPurchaseStatus::cannot(RetailPurchaseStatus::PENDING, RetailPurchaseStatus::CANCELED));
        $this->assertFalse(RetailPurchaseStatus::cannot(RetailPurchaseStatus::PENDING, RetailPurchaseStatus::REFUNDED));

        $this->assertTrue(RetailPurchaseStatus::cannot(RetailPurchaseStatus::COMPLETED, RetailPurchaseStatus::PENDING));
        $this->assertTrue(RetailPurchaseStatus::cannot(RetailPurchaseStatus::COMPLETED, RetailPurchaseStatus::CANCELED));
        $this->assertFalse(RetailPurchaseStatus::cannot(RetailPurchaseStatus::COMPLETED, RetailPurchaseStatus::REFUNDED));

        $this->assertTrue(RetailPurchaseStatus::cannot(RetailPurchaseStatus::CANCELED, RetailPurchaseStatus::PENDING));
        $this->assertTrue(RetailPurchaseStatus::cannot(RetailPurchaseStatus::CANCELED, RetailPurchaseStatus::COMPLETED));
        $this->assertTrue(RetailPurchaseStatus::cannot(RetailPurchaseStatus::CANCELED, RetailPurchaseStatus::REFUNDED));

        $this->assertTrue(RetailPurchaseStatus::cannot(RetailPurchaseStatus::REFUNDED, RetailPurchaseStatus::PENDING));
        $this->assertTrue(RetailPurchaseStatus::cannot(RetailPurchaseStatus::REFUNDED, RetailPurchaseStatus::COMPLETED));
        $this->assertTrue(RetailPurchaseStatus::cannot(RetailPurchaseStatus::REFUNDED, RetailPurchaseStatus::CANCELED));
    }
}

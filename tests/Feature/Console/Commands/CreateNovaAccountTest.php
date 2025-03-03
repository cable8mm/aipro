<?php

namespace Tests\Feature\Console\Commands;

use Tests\TestCase;

class CreateNovaAccountTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_console_command(): void
    {
        $this->artisan('aipro:create-nova-account')->assertSuccessful();
    }
}

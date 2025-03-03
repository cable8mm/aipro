<?php

namespace Tests\Feature\Controllers;

use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    public function test_invoke_visited(): void
    {
        $response = $this->get(route('home'));

        $response->assertStatus(200);
    }
}

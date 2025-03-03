<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MonitorControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_invoke_visited_under_logout(): void
    {
        $response = $this->get(route('monitor'));

        $response->assertRedirect(route('login'));
    }

    public function test_invoke_visited_under_login(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get(route('monitor'));

        $response->assertStatus(200);
    }
}

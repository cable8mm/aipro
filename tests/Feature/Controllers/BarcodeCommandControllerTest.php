<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BarcodeCommandControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_invoke_visited_under_logout(): void
    {
        $response = $this->get(route('barcode-command'));

        $response->assertRedirect(route('login'));
    }

    public function test_invoke_visited_under_login(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get(route('barcode-command'));

        $response->assertStatus(200);
    }
}

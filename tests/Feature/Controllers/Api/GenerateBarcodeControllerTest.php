<?php

namespace Tests\Feature\Controllers\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GenerateBarcodeControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_invoke_visited_under_logout(): void
    {
        $response = $this->getJson(route('generate-barcode', ['barcode' => '13213212']));

        $response->assertStatus(401);
    }

    public function test_invoke_visited_under_login(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->getJson(route('generate-barcode', ['barcode' => '13213212']));

        $response->assertStatus(200);
    }
}

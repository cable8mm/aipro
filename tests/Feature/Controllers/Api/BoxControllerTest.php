<?php

namespace Tests\Feature\Controllers\Api;

use App\Models\User;
use Database\Seeders\BoxSeeder;
use Database\Seeders\BoxSupplierSeeder;
use Database\Seeders\LocationSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\WarehouseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BoxControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_show_from_sku_visited_under_logout(): void
    {
        $response = $this->getJson(route('box.show-from-sku', ['sku' => 'BOX1']));

        $response->assertStatus(401);
    }

    public function test_show_from_sku_visited_under_login(): void
    {
        $this->seed([
            UserSeeder::class,
            WarehouseSeeder::class,
            LocationSeeder::class,
            BoxSupplierSeeder::class,
            BoxSeeder::class,
        ]);

        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->getJson(route('box.show-from-sku', ['sku' => 'BOX1']));

        $response->assertStatus(200);
    }
}

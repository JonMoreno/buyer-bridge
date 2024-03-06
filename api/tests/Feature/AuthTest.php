<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

class AuthTest extends TestCase
{
    /**
     * A basic feature login test example.
     */
    public function test_get_auth_user(): void
    {
        Sanctum::actingAs(User::factory()->create(), ['*']);
        $response = $this->get('/api/user');
        $response->assertOk();
    }
}

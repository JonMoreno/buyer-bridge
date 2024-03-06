<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TimeCapsuleTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get_user_capsules(): void
    {
        Sanctum::actingAs(User::factory()->create(), ['*']);
        $response = $this->get('/api/capsules');
        $response->assertOk();
    }

    /**
     * A basic feature test example.
     */ 
    public function test_create_capsule(): void
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user, ['*']);
        $response = $this->postJson('/api/capsules', [
            'title' => 'Test Capsule',
            'message' => 'This is a test capsule.',
            'openAtDate' => "2024-12-31",
            'openAtTime' => "12:00:00"
        ]);
        $response->assertStatus(201);
    }
}

<?php

namespace Tests\Feature;

use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use WithFaker;

    protected UserService $userService;
    protected function setUp(): void
    {
        parent::setUp();
        $this->userService = app(UserService::class);
        $this->setUpFaker();
    }

    public function test_it_can_create_a_user(): void
    {
        $userData = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password123'),
        ];

        $response = $this->userService->store($userData);
        $this->assertNotNull($response);
        $this->assertEquals($userData['name'], $response->name);
        $this->assertDatabaseHas('users', [
            'email' => $userData['email'],
        ]);
    }
}

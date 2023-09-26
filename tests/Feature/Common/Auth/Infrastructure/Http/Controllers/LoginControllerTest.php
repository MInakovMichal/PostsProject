<?php

namespace Tests\Feature\Common\Auth\Infrastructure\Http\Controllers;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Tests\AppTestCase;

class LoginControllerTest extends AppTestCase
{
    public function test_LoginScreenCanBeRendered(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_UsersCanAuthenticateUsingTheLoginScreen(): void
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => config('admin.default_admin_password'),
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    public function testUsersCanNotAuthenticateWithInvalidPassword(): void
    {
        $user = User::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }

    public function testUsersCanLogout(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $this->post('/logout');

        $this->assertGuest();
    }
}

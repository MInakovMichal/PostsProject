<?php

namespace Tests\Feature\Common\Auth\Infrastructure\Http\Controllers;

use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Notification;
use Tests\AppTestCase;

class RegisterControllerTest extends AppTestCase
{
    public function test_RegistrationScreenCanBeRendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_NewUsersCanRegister(): void
    {
        Notification::fake();
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => config('admin.default_admin_password'),
            'password_confirmation' => config('admin.default_admin_password'),
        ]);

        $response->assertRedirect(RouteServiceProvider::HOME);
        Notification::assertCount(1);
    }
}

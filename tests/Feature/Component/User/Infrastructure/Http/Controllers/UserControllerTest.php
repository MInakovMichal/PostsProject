<?php

namespace Tests\Feature\Component\User\Infrastructure\Http\Controllers;

use App\Models\User;
use Tests\AppTestCase;

class UserControllerTest extends AppTestCase
{
    public function test_AddPostFormFormScreenCanBeRendered(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this
            ->from('/')
            ->post('/setLocale/en');

        $response->assertRedirect('/');
    }
}

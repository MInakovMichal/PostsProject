<?php

namespace Tests\Feature\Component\User\Infrastructure\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
use Tests\AppTestCase;

/**
 * @property User|Collection|Model $user
 */
class NotificationControllerTest extends AppTestCase
{
    public function test_AddNotificationFormScreenCanBeRendered(): void
    {
        $response = $this->get('/notification');

        $response->assertStatus(200);
    }

    public function test_UsersCanSendNotificationUsingTheAddNotificationFormScreen(): void
    {
        Mail::fake();
        $user = User::factory()->create();

        $response = $this->post('/notification', [
            'user' => $user->getId(),
            'value' => $this->faker->sentence,
            'image' => UploadedFile::fake()->image($this->faker->word . '.jpeg', 800, 600)
        ]);

        $response->assertRedirect('/notification');
        Mail::assertSentCount(1);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }
}

<?php

namespace Tests\Feature\Component\Post\Infrastructure\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Tests\AppTestCase;

/**
 * @property User|Collection|Model $user
 */
class PostControllerTest extends AppTestCase
{
    public function test_AddPostFormFormScreenCanBeRendered(): void
    {
        $response = $this->get('/post');

        $response->assertStatus(200);
    }

    public function test_UsersCanAddPostUsingTheAddPostFormScreen(): void
    {
        $response = $this->post('/post', [
            'value' => $this->faker->sentence,
            'image' => UploadedFile::fake()->image($this->faker->word . '.jpeg', 800, 600)
        ]);

        $response->assertRedirect('/');
    }

    public function test_UserWithRoleAdminCanDeletePost(): void
    {
        $post = Post::factory()->create(['user_id' => $this->user->getId()]);
        $this->user->assignRole('admin');
        $response = $this->delete('/post', [
            'id' => $post->getId(),
        ]);
        $response->assertStatus(200);
    }

    public function test_UserWithoutRoleAdminCanNotDeletePost(): void
    {
        $this->expectException(UnauthorizedException::class);

        $post = Post::factory()->create(['user_id' => $this->user->getId()]);

        $this->delete('/post', [
            'id' => $post->getId(),
        ])->json();
    }

    public function test_UsersCanDisplayAllPosts(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }
}

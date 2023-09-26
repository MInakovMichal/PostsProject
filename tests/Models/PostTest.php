<?php

namespace Tests\Models;

use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Common\Exception\UserIdNotSetException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Tests\AppTestCase;

/**
 * @property Post|User|Collection|Model $user
 * @property int $id
 * @property Post|Collection|Model $post
 * @property string $createdAt
 */
class PostTest extends AppTestCase
{
    public function test_GetId_ShouldReturnPostId(): void
    {
        $this->assertSame($this->id, $this->post->getId());
    }

    public function test_GetUserId_ShouldThrowNewUserIdNotSetException(): void
    {
        $this->expectException(UserIdNotSetException::class);
        $this->post->getUserId();
    }

    public function test_GetUserId_ShouldReturnUserId(): void
    {
        $user = User::factory()->make(['id' => $this->id]);

        $this->post->setUserId($user->getId());

        $this->assertSame($user->getId(), $this->post->getUserId());
        $this->post->getUserId();

    }

    public function test_GetValue_ShouldReturnPostValue(): void
    {
        $this->assertFalse($this->post->hasValue());
        $this->assertNull($this->post->getValue());

        $value = $this->faker->sentence;
        $this->post->setValue($value);

        $this->assertSame($value, $this->post->getValue());
        $this->assertTrue($this->post->hasValue());
    }

    public function test_GetImagePath_ShouldReturnPostImagePath(): void
    {
        $this->assertFalse($this->post->hasImage());
        $this->assertNull($this->post->getImagePath());

        $image = $this->faker->imageUrl;
        $this->post->setImagePath($image);

        $this->assertSame($image, $this->post->getImagePath());
        $this->assertTrue($this->post->hasImage());
    }

    public function test_GetCreatedAt_ShouldReturnPostCreatedAt(): void
    {
        $this->assertSame($this->createdAt, $this->post->getCreatedAt());
    }

    public function test_GetUser_ShouldReturnPostAuthor(): void
    {
        $this->post->setUserId($this->user->getId());

        $this->assertSame($this->user->getId(), $this->post->getUser()->first()->getId());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->id = 1;

        $this->user = User::factory()->make(['id' => $this->id]);

        $this->createdAt = Carbon::now()->toDateTimeString();

        $this->post = Post::factory()->make([
            'id' => $this->id,
            'user_id' => null,
            'created_at' => $this->createdAt
        ]);
    }
}

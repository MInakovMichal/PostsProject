<?php

namespace Tests\Unit\Component\Post\Infrastructure\Service;

use App\Models\Post;
use App\Models\User;
use Common\Exception\PostNotFoundException;
use Component\Post\Infrastructure\Http\Requests\AddPostRequest;
use Component\Post\Infrastructure\Service\PostServiceImpl;
use Component\Post\Sdk\Model\PostRead;
use Illuminate\Foundation\Application;
use Tests\AppTestCase;

/**
 * @property int $postId
 * @property int $postUserId
 * @property \Illuminate\Contracts\Foundation\Application|Application|mixed $mock
 */
class PostServiceTest extends AppTestCase
{
    public function test_FindByIdOrFail_ShouldReturnPost_WhenPostExists(): void
    {
        $post = $this->mock->findByIdOrFail($this->postId);

        $this->assertInstanceOf(PostRead::class, $post);
    }

    public function test_FindByIdOrFail_ShouldThrowUPostNotFoundException_WhenPostNotExists(): void
    {
        $this->expectException(PostNotFoundException::class);

        $this->mock->findByIdOrFail($this->postId + 1);
    }

    public function test_FindByUserIdOrFail_ShouldReturnPosts_WhenPostsExists(): void
    {
        $posts = $this->mock->findByUserId($this->postUserId);

        $this->assertNotEmpty($posts);
    }

    public function test_FindByUserIdOrFail_ShouldReturnEmptyCollection_WhenPostsNotExists(): void
    {
        $posts = $this->mock->findByUserId($this->postUserId + 1);

        $this->assertEmpty($posts);
    }

    public function test_GetAllPosts_ShouldReturnCollectionWithOneElement_WhenPostsExists(): void
    {
        $posts = $this->mock->getAllPosts();

        $this->assertNotEmpty($posts);
        $this->assertCount(1, $posts);
    }

    public function test_DeletePost_ShouldDeletePost_WhenPostsExists(): void
    {
        $this->mock->deletePost($this->postId);
        $posts = $this->mock->getAllPosts();

        $this->assertEmpty($posts);
    }

    public function test_AddPost_ShouldAddPost(): void
    {
        $this->actingAs(User::find(1));

        $request = new AddPostRequest([
            'value' => $this->faker->sentence,
            'image' => $this->faker->name
        ]);

        $postsBefore = Post::all()->count();

        $this->mock->addPost($request);

        $postsAfter = Post::all()->count();

        $this->assertNotSame($postsBefore, $postsAfter);
        $this->assertSame($postsBefore + 1, $postsAfter);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $post = Post::factory()->create();

        $this->postId = $post->getId();
        $this->postUserId = $post->getUserId();

        $this->mock = app(PostServiceImpl::class);
    }
}

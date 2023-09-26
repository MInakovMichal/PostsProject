<?php

namespace Tests\Unit\Component\Post\Infrastructure\Mapper;

use App\Models\Post;
use Component\Post\Infrastructure\Mapper\PostEntityMapper;
use Component\Post\Sdk\Model\PostRead;
use Tests\AppTestCase;

class PostEntityMapperTest extends AppTestCase
{
    public function test_MapToReadModel_ShouldReturnUserRead(): void
    {
        $mapper = new PostEntityMapper();

        $post = Post::factory()->make(['id' => 1]);
        $postRead = $mapper->mapToReadModel($post);

        $this->assertInstanceOf(PostRead::class, $postRead);
    }
}

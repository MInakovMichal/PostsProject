<?php

declare(strict_types=1);

namespace Component\Post\Infrastructure\Mapper;

use App\Models\Post;
use Component\Post\Sdk\Model\PostRead;

final class PostEntityMapper
{
    public function mapToReadModel(Post $postEntity): PostRead
    {
        return new PostRead(
            $postEntity->getId(),
            $postEntity->getUserId(),
            $postEntity->getValue(),
            $postEntity->getImagePath()
        );
    }
}

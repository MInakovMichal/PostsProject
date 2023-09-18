<?php

declare(strict_types=1);

namespace Common\Exception;

class PostNotFoundException extends ApiException
{
    public const MESSAGE = "Post not found with id: ";

    public function __construct(int $id)
    {
        parent::__construct(self::MESSAGE . $id, 404, ['post_id' => $id]);
    }
}

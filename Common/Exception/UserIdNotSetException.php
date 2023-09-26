<?php

declare(strict_types=1);

namespace Common\Exception;

class UserIdNotSetException extends ApiException
{
    public const MESSAGE = 'User id not set fir post with id: ';

    public function __construct(int $id)
    {
        parent::__construct(self::MESSAGE . $id, 403, ['post_id' => $id]);
    }
}

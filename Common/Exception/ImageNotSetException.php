<?php

declare(strict_types=1);

namespace Common\Exception;

class ImageNotSetException extends ApiException
{
    public const MESSAGE = 'Image Not set';

    public function __construct()
    {
        parent::__construct(self::MESSAGE, 403);
    }
}

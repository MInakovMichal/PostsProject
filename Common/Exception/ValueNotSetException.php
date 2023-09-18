<?php

declare(strict_types=1);

namespace Common\Exception;

class ValueNotSetException extends ApiException
{
    public const MESSAGE = 'Value Not set';

    public function __construct()
    {
        parent::__construct(self::MESSAGE, 403);
    }
}

<?php

declare(strict_types=1);

namespace Common\Exception;

class LanguageByCodeNotFoundException extends ApiException
{
    public const MESSAGE = "Language not found with code: ";

    public function __construct(string $code)
    {
        parent::__construct(self::MESSAGE . $code, 404, ['language_code' => $code]);
    }
}

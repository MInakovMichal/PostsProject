<?php

namespace Component\Language\Infrastructure\Service;

use Component\Language\Sdk\Model\LanguageRead;
use Illuminate\Database\Eloquent\Collection;

interface LanguageService
{
    public function getAllLanguages(): Collection;

    public function findLanguageByCodeOrFail(string $code): LanguageRead;
}

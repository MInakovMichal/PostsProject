<?php

namespace Component\Language\Sdk;

use Component\Language\Sdk\Model\LanguageRead;
use Illuminate\Database\Eloquent\Collection;

interface LanguageFacade
{
    public function getAllLanguages(): Collection;

    public function findLanguageByCodeOrFail(string $code): LanguageRead;
}

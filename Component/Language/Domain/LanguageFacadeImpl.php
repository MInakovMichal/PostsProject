<?php

namespace Component\Language\Domain;

use Component\Language\Infrastructure\Service\LanguageService;
use Component\Language\Sdk\LanguageFacade;
use Component\Language\Sdk\Model\LanguageRead;
use Illuminate\Database\Eloquent\Collection;

class LanguageFacadeImpl implements LanguageFacade
{
    public function __construct(readonly LanguageService $languageService)
    {
    }

    public function getAllLanguages(): Collection
    {
        return $this->languageService->getAllLanguages();
    }

    public function findLanguageByCodeOrFail(string $code): LanguageRead
    {
        return $this->languageService->findLanguageByCodeOrFail($code);
    }
}

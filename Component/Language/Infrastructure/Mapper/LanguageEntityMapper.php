<?php

namespace Component\Language\Infrastructure\Mapper;

use App\Models\Language;
use Component\Language\Sdk\Model\LanguageRead;

class LanguageEntityMapper
{
    public function mapToReadModel(Language $language): LanguageRead
    {
        return new LanguageRead(
            $language->getId(),
            $language->getName(),
            $language->getCode()
        );
    }
}

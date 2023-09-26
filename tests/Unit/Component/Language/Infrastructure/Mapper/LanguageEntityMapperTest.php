<?php

namespace Tests\Unit\Component\Language\Infrastructure\Mapper;

use App\Models\Language;
use Component\Language\Infrastructure\Mapper\LanguageEntityMapper;
use Component\Language\Sdk\Model\LanguageRead;
use PHPUnit\Framework\TestCase;

class LanguageEntityMapperTest extends TestCase
{
    public function test_MapToReadModel_ShouldReturnLanguageRead(): void
    {
        $mapper = new LanguageEntityMapper();

        $language = Language::factory()->make(['id' => 1]);
        $languageRead = $mapper->mapToReadModel($language);

        $this->assertInstanceOf(LanguageRead::class, $languageRead);
    }
}

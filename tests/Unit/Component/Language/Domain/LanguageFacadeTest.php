<?php

namespace Tests\Unit\Component\Language\Domain;

use App\Models\Language;
use Common\Exception\LanguageByCodeNotFoundException;
use Component\Language\Domain\LanguageFacadeImpl;
use Component\Language\Sdk\Model\LanguageRead;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Application;
use Tests\AppTestCase;

/**
 * @property Language|Collection|Model $language
 * @property \Illuminate\Contracts\Foundation\Application|Application|mixed $mock
 */
class LanguageFacadeTest extends AppTestCase
{
    public function test_GetAllLanguages_ShouldReturnNotEmptyCollection(): void
    {
        $languages = $this->mock->getAllLanguages();

        $this->assertNotEmpty($languages);
    }

    public function test_FindLanguageByCodeOrFail_ShouldReturnLanguageModel(): void
    {
        $language = $this->mock->findLanguageByCodeOrFail($this->language->getCode());

        $this->assertInstanceOf(LanguageRead::class, $language);
    }

    public function test_FindLanguageByCodeOrFail_ShouldThrowLanguageByCodeNotFoundException(): void
    {
        $this->expectException(LanguageByCodeNotFoundException::class);

        $this->mock->findLanguageByCodeOrFail('test');
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->language = Language::factory()->create();

        $this->mock = app(LanguageFacadeImpl::class);
    }
}

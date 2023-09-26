<?php

namespace Tests\Unit\Component\Language\Sdk\Model;

use Component\Language\Sdk\Model\LanguageRead;
use Tests\AppTestCase;

/**
 * @property int $id
 * @property string $name
 * @property string $code
 * @property LanguageRead $languageRead
 */
class LanguageReadTest extends AppTestCase
{
    public function test_GetId_ShouldReturnLanguageId(): void
    {
        $this->assertSame($this->id, $this->languageRead->getId());
    }

    public function test_GetName_ShouldReturnLanguageName(): void
    {
        $this->assertSame($this->name, $this->languageRead->getName());
    }

    public function test_GetCode_ShouldReturnLanguageEmail(): void
    {
        $this->assertSame($this->code, $this->languageRead->getCode());
    }

    public function test_ToArray_ShouldReturnArray(): void
    {
        $expected = [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code
        ];

        $this->assertSame(json_encode($expected), json_encode($this->languageRead->toArray()));
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->id = 1;
        $this->name = $this->faker->name;
        $this->code = $this->faker->randomLetter;

        $this->languageRead = new LanguageRead(
            $this->id,
            $this->name,
            $this->code
        );
    }

}

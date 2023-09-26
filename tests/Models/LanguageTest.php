<?php

namespace Tests\Models;

use App\Models\Language;
use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Tests\AppTestCase;

/**
 * @property int $id
 * @property string $code
 * @property string $name
 * @property Post|Collection|Model $language
 */
class LanguageTest extends AppTestCase
{
    public function test_GetId_ShouldReturnPostId(): void
    {
        $this->assertSame($this->id, $this->language->getId());
    }

    public function test_GetName_ShouldReturnPostName(): void
    {
        $this->assertSame($this->name, $this->language->getName());
    }

    public function test_GetCode_ShouldReturnPostCode(): void
    {
        $this->assertSame($this->code, $this->language->getCode());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->id = 1;

        $this->code = 'test_code';
        $this->name = 'test_name';

        $this->language = Language::factory()->make([
            'id' => $this->id,
            'code' => $this->code,
            'name' => $this->name
        ]);
    }

}

<?php

namespace Tests\Unit\Component\Post\Sdk\Model;

use Component\Post\Sdk\Model\PostRead;
use Tests\AppTestCase;

/**
 * @property int $id
 * @property string $user_id
 * @property string $value
 * @property string $imagePath
 * @property PostRead $postRead
 */
class PostReadTest extends AppTestCase
{
    public function test_GetId_ShouldReturnUserId(): void
    {
        $this->assertSame($this->id, $this->postRead->getId());
    }

    public function test_GetUserId_ShouldReturnUserId(): void
    {
        $this->assertSame($this->user_id, $this->postRead->getUserId());
    }

    public function test_GetValue_ShouldReturnValue(): void
    {
        $this->assertSame($this->value, $this->postRead->getValue());
    }

    public function test_GetImagePath_ShouldReturnImagePath(): void
    {
        $this->assertSame($this->imagePath, $this->postRead->getImagePath());
    }

    public function test_ToArray_ShouldReturnArray(): void
    {
        $expected = [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'value' => $this->value,
            'image_path' => $this->imagePath
        ];

        $this->assertSame(json_encode($expected), json_encode($this->postRead->toArray()));
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->id = 1;
        $this->user_id = 1;
        $this->value = $this->faker->sentence;
        $this->imagePath = $this->faker->name;

        $this->postRead = new PostRead(
            $this->id,
            $this->user_id,
            $this->value,
            $this->imagePath
        );
    }

}

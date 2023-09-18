<?php

namespace Component\Post\Infrastructure\Http\Requests;

use Common\Contract\AddPostContract;
use Common\Exception\ImageNotSetException;
use Common\Exception\ValueNotSetException;
use Common\Http\BaseRequest;
use Illuminate\Http\UploadedFile;

class AddPostRequest extends BaseRequest implements AddPostContract
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'value' => ['required_without:image'],
            'image' => ['required_without:value', 'image', 'mimes:jpeg,png,jpg,gif'],
        ];
    }

    public function getValue(): string
    {
        if (!$this->hasValue()) {
            throw new ValueNotSetException();
        }

        /** @var string $value */
        $value = $this->get('value');
        return $value;
    }

    public function getImage(): UploadedFile
    {
        if (!$this->hasImage()) {
            throw new ImageNotSetException();
        }

        /** @var UploadedFile $image */
        $image = $this->file('image');
        return $image;
    }

    public function hasValue(): bool
    {
        return $this->get('value') !== null;
    }

    public function hasImage(): bool
    {
        return $this->file('image') !== null;
    }
}

<?php

namespace Component\User\Infrastructure\Http\Requests;

use Common\Contract\SendNotificationContract;
use Common\Http\BaseRequest;
use Illuminate\Http\UploadedFile;

class SendNotificationRequest extends BaseRequest implements SendNotificationContract
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'user' => ['required', 'integer', 'exists:users,id'],
            'value' => ['required_without:image'],
            'image' => ['required_without:value', 'image', 'mimes:jpeg,png,jpg,gif'],
        ];
    }

    public function getValue(): ?string
    {
        /** @var string $value */
        $value = $this->get('value');
        return $value;
    }

    public function getImage(): ?UploadedFile
    {
        return $this->file('image');/** @phpstan-ignore-line */
    }

    public function hasValue(): bool
    {
        return $this->get('value') !== null;
    }

    public function hasImage(): bool
    {
        return $this->file('image') !== null;
    }

    public function getUserId(): int
    {
        /** @var int $id */
        $id = $this->get('user');
        return $id;
    }
}

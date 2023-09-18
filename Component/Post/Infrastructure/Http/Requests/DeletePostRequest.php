<?php

namespace Component\Post\Infrastructure\Http\Requests;

use Common\Contract\DeletePostContract;
use Common\Http\BaseRequest;

class DeletePostRequest extends BaseRequest implements DeletePostContract
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'id' => ['required', 'integer', 'exists:posts,id'],
        ];
    }

    public function getId(): int
    {
        /** @var int $id */
        $id = $this->get('id');
        return $id;
    }
}

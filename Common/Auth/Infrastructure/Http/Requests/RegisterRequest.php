<?php

namespace Common\Auth\Infrastructure\Http\Requests;

use Common\Auth\Sdk\Contract\RegisterContract;
use Common\Http\BaseRequest;
use Common\ValueObject\Email;

class RegisterRequest extends BaseRequest implements RegisterContract
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        /** @var string $maxLength */
        $maxLength = config('auth.maxPasswordLength');

        /** @var string $regexRule */
        $regexRule = config('auth.password_regex.rule');
        return [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'name' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'max:' . $maxLength, 'confirmed', 'regex:' . $regexRule],
            'password_confirmation' => ['required', 'string', 'min:8', 'max:' . $maxLength, 'regex:' . $regexRule],
        ];
    }

    public function getName(): string
    {
        /** @var string $name */
        $name = $this->get('name');
        return $name;
    }

    public function getEmail(): Email
    {
        /** @var string $email */
        $email = $this->get('email');
        return new Email($email);
    }

    public function getPassword(): string
    {
        /** @var string $password */
        $password = $this->get('password');
        return $password;
    }
}

<?php

namespace Common\Auth\Infrastructure\Http\Requests;

use Common\Auth\Sdk\Contract\LoginContract;
use Common\ValueObject\Email;
use Illuminate\Foundation\Http\FormRequest;
use InvalidArgumentException;

class LoginRequest extends FormRequest implements LoginContract
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
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'max:' . $maxLength, 'regex:' . $regexRule],
        ];
    }

    public function getEmail(): Email
    {
        if (!$this->hasEmail()) {
            throw new InvalidArgumentException("Email not found");
        }
        /** @var string $email */
        $email = $this->get('email');

        return new Email($email);
    }

    public function hasEmail(): bool
    {
        return $this->get('email') !== null;
    }

    public function getPassword(): string
    {
        /** @var string $password */
        $password = $this->get('password');
        return $password;
    }

    public function isRemember(): bool
    {
        return $this->boolean('remember');
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

class LoginRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ];
    }

    public function getCredentials(): array
    {
        $username = $this->get('username');
        $password = $this->get('password');

        if ($this->isEmail($username)) {
            return [
                'email' => $username,
                'password' => $password,
            ];
        }

        return [
            'username' => $username,
            'password' => $password,
        ];
    }

    private function isEmail(string $value): bool
    {
        return Validator::make(['username' => $value], ['username' => ['email']])->passes();
    }
}

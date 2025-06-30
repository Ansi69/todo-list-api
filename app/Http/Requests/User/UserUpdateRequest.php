<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserUpdateRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            "name" => ['sometimes', 'string', 'min:3', 'max:50'],
            "email" => ['sometimes', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->route('user'))],
            "password" => ['sometimes', Password::min(8)->letters()->mixedCase()->numbers()->symbols()->uncompromised()],
            "role_id" => ['sometimes', 'integer', 'exists:roles,id'],
        ];
    }
}

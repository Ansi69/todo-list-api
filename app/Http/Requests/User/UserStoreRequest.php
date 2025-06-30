<?php

namespace App\Http\Requests\User;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserStoreRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "name" => ['required', 'string', 'min:3', 'max:50'],
            "email" => ['required', 'string', 'email', 'max:255', 'unique:users'],
            "password" => ['required', Password::min(8)->letters()->mixedCase()->numbers()->symbols()->uncompromised()],
            "role_id" => ['required', 'integer', 'exists:roles,id'],
        ];
    }
}

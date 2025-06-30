<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserFilterRequest extends FormRequest
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
            'search' => ['nullable', 'string', 'min:1', 'max:100'],
            'role_id' => ['nullable', 'integer', 'exists:roles,id'],
            'order_by' => ['nullable', 'string', Rule::in(['created_at', 'name'])],
            'order_direction' => ['nullable', 'string', Rule::in(['asc', 'desc'])],
            'per_page' => ['nullable', 'int', 'min:1', 'max:100'],
        ];
    }
}

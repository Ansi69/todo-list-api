<?php

namespace App\Http\Requests\Note;

use Illuminate\Foundation\Http\FormRequest;

class NoteStoreRequest extends FormRequest
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
            "title" => ['required', 'string', 'min:1', 'max:50'],
            "content" => ['required', 'string', 'min:1'],
        ];
    }
}

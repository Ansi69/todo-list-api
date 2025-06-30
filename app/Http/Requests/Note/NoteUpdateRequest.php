<?php

namespace App\Http\Requests\Note;


class NoteUpdateRequest extends NoteStoreRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            "status_id" => ['required', 'int', 'exists:statuses,id'],
        ]);
    }
}

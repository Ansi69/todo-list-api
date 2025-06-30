<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Note\NoteResource;
use Illuminate\Http\Request;

class UserNoteResource extends UserResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        $array = parent::toArray($request);
        $array['notes'] = NoteResource::collection($this->notes);

        return $array;
    }
}

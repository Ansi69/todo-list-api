<?php

namespace App\Http\Resources\Note;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Note */
class NoteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->title,
            'content' => $this->content,
            'created_date' => $this->created_at?->format('d.m.Y'),
            'updated_date' => $this->updated_at?->format('d.m.Y'),
            'archived_date' => $this->deleted_at?->format('d.m.Y'),
            'author_id' => $this->user_id,
            'status' => NoteStatusResource::make($this->status),
        ];
    }
}

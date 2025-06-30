<?php

namespace App\Repositories;

use App\DTO\Note\NoteFilter;
use App\Models\Note;
use App\Repositories\Abstracts\NoteRepository;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Pagination\LengthAwarePaginator;
use Prettus\Repository\Eloquent\BaseRepository;

class NoteRepositoryEloquent extends BaseRepository implements NoteRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return Note::class;
    }

    /**
     * @param NoteFilter $filter
     * @return LengthAwarePaginator
     */
    public function getNotesPaginated(NoteFilter $filter): LengthAwarePaginator
    {
        return $this
            ->with(['user', 'status'])
            ->orderBy($filter->orderBy, $filter->orderDirection)
            ->withTrashed()
            ->paginate($filter->perPage);
    }

    /**
     * @param NoteFilter $filter
     * @return LengthAwarePaginator
     */
    public function getNotesFromUserPaginated(NoteFilter $filter): LengthAwarePaginator
    {
        return $this->notesFromUserQuery($filter)->paginate($filter->perPage);
    }

    /**
     * @param NoteFilter $filter
     * @return HasMany
     */
    private function notesFromUserQuery(NoteFilter $filter): HasMany
    {
        return $filter->user->notes()
            ->with(['status'])
            ->withTrashed()
            ->orderBy($filter->orderBy, $filter->orderDirection);
    }
}

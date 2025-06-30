<?php

namespace App\Services;

use App\Domain\Enums\StatusEnum;
use App\DTO\Note\NoteFilter;
use App\Models\Note;
use App\Models\User;
use App\Repositories\Abstracts\NoteRepository;
use App\Services\Abstracts\NoteServiceInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class NoteService implements NoteServiceInterface
{
    public function __construct(
        protected NoteRepository $noteRepository,
    ) {
    }

    /**
     * @param  User  $user
     * @param  array  $data
     * @return Note
     */
    public function createNote(User $user, array $data): Note
    {
        $data['status_id'] = StatusEnum::planned->value;

        return $user->notes()->create($data);
    }

    /**
     * @param  Note  $note
     * @param  array  $data
     * @return Note
     */
    public function updateNote(Note $note, array $data): Note
    {
        $note->update($data);

        return $note->refresh();
    }

    /**
     * @param  Note  $note
     * @return void
     */
    public function deleteNote(Note $note): void
    {
        $note->update(['status_id' => StatusEnum::archived->value]);
        $note->delete();
    }

    /**
     * @param  NoteFilter  $filter
     * @return LengthAwarePaginator
     */
    public function getAllNotes(NoteFilter $filter): LengthAwarePaginator
    {
        return $this->noteRepository->getNotesPaginated($filter);
    }

    /**
     * @param  NoteFilter  $filter
     * @return LengthAwarePaginator
     */
    public function getUserNotes(NoteFilter $filter): LengthAwarePaginator
    {
        return $this->noteRepository->getNotesFromUserPaginated($filter);
    }
}

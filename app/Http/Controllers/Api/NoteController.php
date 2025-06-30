<?php

namespace App\Http\Controllers\Api;

use App\DTO\Note\NoteFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Note\NoteFilterRequest;
use App\Http\Requests\Note\NoteStoreRequest;
use App\Http\Requests\Note\NoteUpdateRequest;
use App\Http\Resources\Note\NoteResource;
use App\Models\Note;
use App\Services\Abstracts\MailServiceInterface;
use App\Services\NoteService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Throwable;

class NoteController extends Controller
{
    use AuthorizesRequests;

    /**
     * @param NoteService $noteService
     * @param MailServiceInterface $mailService
     */
    public function __construct(
        protected NoteService          $noteService,
        protected MailServiceInterface $mailService,
    )
    {
    }

    /**
     * @param NoteFilterRequest $request
     * @return AnonymousResourceCollection
     */
    public function list(NoteFilterRequest $request): AnonymousResourceCollection
    {
        $this->authorize('view-any', Note::class);

        return NoteResource::collection(
            $this->noteService->getAllNotes(NoteFilter::fromRequest($request))
        );
    }

    /**
     * @param NoteFilterRequest $request
     * @return AnonymousResourceCollection
     */
    public function index(NoteFilterRequest $request): AnonymousResourceCollection
    {
        $this->authorize('index', Note::class);

        return NoteResource::collection(
            $this->noteService->getUserNotes(NoteFilter::fromRequest($request))
        );
    }

    /**
     * @param NoteStoreRequest $request
     * @return NoteResource
     */
    public function store(NoteStoreRequest $request): NoteResource
    {
        $this->authorize('create', Note::class);

        $note = $this->noteService->createNote(Auth::user(), $request->validated());
        $this->mailService->notificationAfterNoteCreated($note);
        NoteResource::withoutWrapping();

        return NoteResource::make($note);
    }

    /**
     * @param Note $note
     * @return NoteResource
     */
    public function show(Note $note): NoteResource
    {
        $this->authorize('view', $note);

        return NoteResource::make($note);
    }

    /**
     * @param NoteUpdateRequest $request
     * @param Note $note
     * @return NoteResource
     */
    public function update(NoteUpdateRequest $request, Note $note): NoteResource
    {
        $this->authorize('update', $note);

        return NoteResource::make(
            $this->noteService->updateNote($note, $request->validated())
        );
    }

    /**
     * @param Note $note
     * @return Response
     * @throws Throwable
     */
    public function destroy(Note $note): Response
    {
        $this->authorize('delete', $note);

        if (!is_null($note->deleted_at)) {
            abort(Response::HTTP_BAD_REQUEST, __('exceptions.note_already_deleted'));
        }

        $this->noteService->deleteNote($note);
        return response()->noContent();
    }
}

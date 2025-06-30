<?php

namespace App\Services;

use App\Models\Note;
use App\Models\User;
use App\Notifications\NoteCreatedNotification;
use App\Repositories\Abstracts\UserRepository;
use App\Services\Abstracts\MailServiceInterface;

class MailService implements MailServiceInterface
{
    public function __construct(
        protected UserRepository $userRepository,
    )
    {
    }

    /**
     * @param Note $note
     * @return void
     */
    public function notificationAfterNoteCreated(Note $note): void
    {
        $admins = $this->userRepository->getAdmins()->filter(fn(User $admin) => $admin->id !== $note->user_id);
        $admins->each(fn(User $admin) => $admin->notify(new NoteCreatedNotification($note)));
    }
}

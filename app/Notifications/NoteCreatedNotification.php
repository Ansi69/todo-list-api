<?php

namespace App\Notifications;

use App\Models\Note;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NoteCreatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private Note $note;

    /**
     * Create a new notification instance.
     */
    public function __construct(Note $note)
    {
        $this->note = $note;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->greeting('Привет!')
            ->line('Это уведомление приходит когда создается новая заметка')
            ->line("Создал заметку: {$this->note->user->name}.")
            ->line("Дата создания: {$this->note->created_at->format('d.m.Y H:m:s')}")
            ->line("Заголовок: {$this->note->title}")
            ->line("Содержание: {$this->note->content}")
            ->line('Спасибо за внимание!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}

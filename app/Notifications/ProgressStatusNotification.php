<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\GoogleChat\GoogleChatChannel;
use NotificationChannels\GoogleChat\GoogleChatMessage;

class ProgressStatusNotification extends Notification
{
    use Queueable;

    protected $user;
    protected $lesson;
    protected $status;
    /**
     * Create a new notification instance.
     */
    public function __construct($user, $lesson, $status)
    {
        $this->user = $user;
        $this->lesson = $lesson;
        $this->status = $status;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return [
            GoogleChatChannel::class
        ];
    }

    public function toGoogleChat(object $notifiable) {
        $chatMessage = new GoogleChatMessage();
        $chatMessage->text('【進捗報告】')
                    ->line("{$this->user->name}さんが講座「{$this->lesson->name}」を終了しました。指導員の方はチェックをして承認してください。");

        return $chatMessage;
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

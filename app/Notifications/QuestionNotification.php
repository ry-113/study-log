<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\GoogleChat\GoogleChatChannel;
use NotificationChannels\GoogleChat\GoogleChatMessage;

class QuestionNotification extends Notification
{
    use Queueable;

    protected $user;
    protected $lesson;
    protected $question;
    /**
     * Create a new notification instance.
     */
    public function __construct($user, $lesson, $question)
    {
        $this->user = $user;
        $this->lesson = $lesson;
        $this->question = $question;
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
        $chatMessage->text('【質問】')
                    ->line('ユーザーネーム：' . $this->user->name)
                    ->line('モジュール名：' . $this->lesson['module']['number'] . ' ' . $this->lesson['module']['name'])
                    ->line('単元名：' . $this->lesson['unit']['name'])
                    ->line('講座名：' . $this->lesson['name'])
                    ->line('質問内容：' . $this->question);

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

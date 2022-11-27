<?php

namespace App\Notifications;

use App\Models\Chat\SocietyChat;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendSocietyNewMessage extends Notification
{
    use Queueable;

    protected $societyChat;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(SocietyChat $societyChat)
    {
        $this->societyChat = $societyChat;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    public function ToDatabase($notifiable)
    {
        return [
              'id' => $this->societyChat->id,
              'title' => 'New Message To Society',
              'society_id' => $this->societyChat->society_id,
              'message' => $this->societyChat->message,
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
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
        $message_ar = ' بارسال رسالة في المجتمع الخاص بك ' . $this->societyChat?->sender->name . 'قام ';
        $message_en = $this->societyChat?->sender->full_name . ' had sent a message in your society';
        return [
              'id' => $this->societyChat->id,
              'type' => 'society_chat',
              'title' => trans('mobile.notifications.content.new_message', locale: 'en'),
              'title_ar' => trans('mobile.notifications.content.new_message', locale: 'ar'),
              'society_id' => $this->societyChat->society_id,
              'message_ar' => $message_ar,
              'message_en' => $message_en
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

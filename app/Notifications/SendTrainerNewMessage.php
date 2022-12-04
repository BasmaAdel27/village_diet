<?php

namespace App\Notifications;

use App\Models\Chat\TrainerMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendTrainerNewMessage extends Notification
{
    use Queueable;

    protected $trainerMessage;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(TrainerMessage $trainerMessage)
    {
        $this->trainerMessage = $trainerMessage;
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
        $message_ar = ' بارسال رسالة اليك ' . $this->trainerMessage?->sender->name . 'قام ';
        $message_en = $this->trainerMessage?->sender->full_name . ' had sent you a message';
        return [
              'id' => $this->trainerMessage->id,
              'type' => 'trainer_chat',
              'title' => trans('mobile.notifications.content.new_message', locale: 'en'),
              'title_ar' => trans('mobile.notifications.content.new_message', locale: 'ar'),
              'message_ar' => $message_ar,
              'message_en' => $message_en,
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

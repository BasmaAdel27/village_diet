<?php

namespace App\Notifications;

use App\Models\Chat\AdminMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendAdminNewMessage extends Notification
{
    use Queueable;

    protected $adminMessage;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(AdminMessage $adminMessage)
    {
        $this->adminMessage = $adminMessage;
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
        $message_ar = $this->adminMessage?->sender->full_name . ' تم استقبال رسالة جديدة من ';
        $message_en = $this->adminMessage?->sender->full_name . ' had sent you a message';
        return [
              'id' => $this->adminMessage->id,
              'type' => 'admin_chat',
              'title' => trans('mobile.notifications.content.new_message', locale: 'en'),
              'title_ar' => trans('mobile.notifications.content.new_message', locale: 'ar'),
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

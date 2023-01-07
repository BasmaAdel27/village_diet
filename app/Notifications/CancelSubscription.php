<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CancelSubscription extends Notification
{
    use Queueable;

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        $message_en = 'The subscription has been cancelled.. Your subscription will continue until the end of the month';
        $message_ar = ' تم الغاء الاشتراك .. سيستمر اشتراكك حتى نهاية الشهر';

        return [
            'type' => 'society',
            'title' => 'تم ألغاء الاشتراك',
            'title_ar' => 'Subscription has been cancelled',
            'message_ar' => $message_ar,
            'message_en' => $message_en
        ];
    }
}

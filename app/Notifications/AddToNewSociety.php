<?php

namespace App\Notifications;

use App\Models\Society\Society;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class AddToNewSociety extends Notification
{
    use Queueable;

    protected $society;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Society $society)
    {
        $this->society = $society;
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
        $message_ar =
              ' تم اضافتك الي مجتمع جديد تحت رعاية المدرب ' . $this->society->trainer->full_name . '
              يتم البدء في تفعيل المجتمع يوم '  . $this->society->date_from;
        $message_en = 'You had added to a new society with the trainer ' . $this->society->trainer->full_name . ' ,it would start at ' . $this->society->date_from;
        return [
              'id' => $this->society->id,
              'type' => 'society',
              'title' => trans('you_had_added_to_society', locale: 'en'),
              'title_ar' => trans('you_had_added_to_society', locale: 'ar'),
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

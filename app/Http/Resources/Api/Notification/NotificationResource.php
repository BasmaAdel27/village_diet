<?php

namespace App\Http\Resources\Api\Notification;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    public function toArray($request)
    {
        $locale = request()->header('Accept-Language') ?? app()->getLocale();
        return [
              'id' => $this->id,
              'type' => @$this->data['type'],
              'title' => $locale == 'ar' ? @$this->data['title_ar'] : @$this->data['title'],
              'body' => $locale == 'ar' ? @$this->data['message_ar'] : @$this->data['message_en'],
              'society_id' => @$this->when(@$this->data['society_id'], @$this->data['society_id']),
              'notify_type' => $this->type,
              'created_at' => $this->created_at?->diffForHumans(),
              'read_at' => optional($this->read_at)->format("Y-m-d H:i"),
              'user_image' => auth()->user()->image
        ];
    }
}

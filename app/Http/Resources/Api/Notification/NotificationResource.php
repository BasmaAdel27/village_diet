<?php

namespace App\Http\Resources\Api\Notification;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => @$this->data['title'],
            'body' => @$this->data['body'],
            'notify_type' => $this->type,
            'created_at' => $this->created_at?->diffForHumans(),
            'read_at' => optional($this->read_at)->format("Y-m-d H:i"),
        ];
    }
}

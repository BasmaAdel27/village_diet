<?php

namespace App\Http\Resources\Api\Notification;

use Illuminate\Http\Resources\Json\ResourceCollection;

class NotificationCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'unreadnotifications_count' => (int)auth()->user()->unreadnotifications->count(),
            'notifications' => NotificationResource::collection($this->collection)
        ];
    }
}

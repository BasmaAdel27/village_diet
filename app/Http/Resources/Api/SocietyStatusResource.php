<?php

namespace App\Http\Resources\Api;

use App\Http\Resources\Api\subscriptions\LogsResource;
use App\Models\Day\Day;
use Illuminate\Http\Resources\Json\JsonResource;

class SocietyStatusResource extends JsonResource
{

    public function toArray($request)
    {
        $dayNumber = now()->diffInDays($this->currentSubscription?->created_at) + 1;
        $day = Day::where('number', $dayNumber)->first();

        return [
              'subscription_day' => DayResource::make($day),
              'current_subscription' => LogsResource::make($this->currentSubscription),
              'notification_unread' => $this->unreadNotifications()->count(),
              'trainer_id' => auth()->user()->society->trainer->id,
        ];
    }
}

<?php

namespace App\Http\Resources\Api;

use App\Http\Resources\Api\subscriptions\LogsResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionsResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'subscriptions' => LogsResource::collection($this->logs),
            'active_subscription' => LogsResource::make($this->active_subscription),
            'subscription_count' => auth()->user()->subscriptions()->count()
        ];
    }
}

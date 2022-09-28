<?php

namespace App\Http\Resources\Api;

use App\Http\Resources\Api\subscriptions\LogsResource;
use App\Http\Resources\Api\subscriptions\SubscriptionsCountResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionsResource extends JsonResource
{

    public function toArray($request)
    {
        return [
              'logs'=>LogsResource::collection($this->logs),
              'active_subscription'=>LogsResource::collection($this->active_subscription),
              'subscription_count'=>SubscriptionsCountResource::make($this->subscription_count),
        ];
    }
}

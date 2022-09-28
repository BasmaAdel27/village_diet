<?php

namespace App\Http\Resources\Api\subscriptions;

use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionsCountResource extends JsonResource
{

    public function toArray($request)
    {
        return [
              'subscription_count'=>$this->subscription_count,
        ];
    }
}

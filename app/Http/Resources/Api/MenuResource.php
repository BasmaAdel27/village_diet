<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class MenuResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'name' => auth()->user()->first_name . ' ' . auth()->user()->last_name,
            'image' => auth()->user()->image,
            'subscription_end_date' => auth()->user()->currentSubscription->end_date->diffForHumans()
        ];
    }
}

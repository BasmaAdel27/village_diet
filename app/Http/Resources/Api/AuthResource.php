<?php

namespace App\Http\Resources\Api;

use App\Models\Day\Day;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
{
    public function toArray($request)
    {
        $dayNumber = now()->diffInDays($this->currentSubscription?->created_at) + 1;
        $day = Day::where('number', $dayNumber)->first();

        return [
            'id' => $this->id,
            "first_name" => $this->first_name,
            "last_name" => $this->last_name,
            "email" => $this->email,
            "user_number" => $this->user_number,
            "phone" => $this->phone,
            "date_of_birth" => $this->date_of_birth,
            "is_active" => (bool) $this->is_active,
            "address" => $this->address,
            "insta_link" => $this->insta_link,
            "twitter_link" => $this->twitter_link,
            "country" => $this->country?->name,
            "state" => $this->state?->name,
            'created_at' => $this->created_at,
            'image' => $this->image,
            'subscription_day' => DayResource::make($day)
        ];
    }
}

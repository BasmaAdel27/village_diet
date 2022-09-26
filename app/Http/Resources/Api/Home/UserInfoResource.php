<?php

namespace App\Http\Resources\Api\Home;

use Illuminate\Http\Resources\Json\JsonResource;

class UserInfoResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "sleep_hours" =>  $this->sleep_hours,
            "daily_cup_count" => $this->daily_cup_count,
            "walk_duration" => $this->walk_duration,
            "weight" => $this->weight,
            "created_at" => $this->created_at,
        ];
    }
}

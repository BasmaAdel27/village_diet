<?php

namespace App\Http\Resources\Api;

use App\Http\Resources\Api\agenda\CurrentSubscriptionResource;
use App\Http\Resources\Api\agenda\DaysResource;
use Illuminate\Http\Resources\Json\JsonResource;

class DateSubscriptionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
              'current_Subscription'=>CurrentSubscriptionResource::make($this->current_Subscription),
//              'days'=>DaysResource::collection($this->days)
        ];
    }
}

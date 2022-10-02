<?php

namespace App\Http\Resources\Api\agenda;

use Illuminate\Http\Resources\Json\JsonResource;

class CurrentSubscriptionResource extends JsonResource
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
              'id'=>$this->id,
              'created_at'=>$this->created_at,
              'end_date'=>$this->end_date->toDateString(),
        ];
    }
}

<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionsResource extends JsonResource
{

    public function toArray($request)
    {
        return [
              'created_at'=>$this->created_at,
              'end_date'=>$this->end_date,
        ];
    }
}

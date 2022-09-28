<?php

namespace App\Http\Resources\Api\subscriptions;

use Illuminate\Http\Resources\Json\JsonResource;

class LogsResource extends JsonResource
{

    public function toArray($request)
    {
        return [
             'created_at'=>$this->created_at,
              'end_date'=>$this->end_date,
              'status'=>$this->status,




        ];
    }
}

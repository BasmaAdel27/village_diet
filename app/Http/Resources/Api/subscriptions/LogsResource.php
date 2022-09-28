<?php

namespace App\Http\Resources\Api\subscriptions;

use Illuminate\Http\Resources\Json\JsonResource;

class LogsResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'start_date' => $this->created_at,
            'end_date' => $this->end_date,
            'status' => $this->status,
        ];
    }
}

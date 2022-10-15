<?php

namespace App\Http\Resources\Api\subscriptions;

use Illuminate\Http\Resources\Json\JsonResource;

class LogsResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'start_date' => $this->created_at,
            'end_date' => date('Y-m-d', strtotime($this->end_date)),
            'status' => (bool)$this->status,
        ];
    }
}

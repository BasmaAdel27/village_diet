<?php

namespace App\Http\Resources\Api\Chat;

use Illuminate\Http\Resources\Json\JsonResource;

class TrainerMessageResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'trainer' => UserResource::make($this->trainer),
            'user' => UserResource::make($this->citizen),
            'type' => $this->type,
            'message' => $this->message,
        ];
    }
}

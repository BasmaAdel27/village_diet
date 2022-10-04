<?php

namespace App\Http\Resources\Api\Chat;

use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{

    public function toArray($request)
    {
        return [
              'id' => $this->id,
              'receiver' => UserResource::make($this->receiver),
              'sender' => UserResource::make($this->sender),
              'type' => $this->type,
              'message' => $this->message,
        ];
    }
}

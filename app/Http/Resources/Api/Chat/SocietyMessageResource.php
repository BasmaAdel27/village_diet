<?php

namespace App\Http\Resources\Api\Chat;

use Illuminate\Http\Resources\Json\JsonResource;

class SocietyMessageResource extends JsonResource
{

    public function toArray($request)
    {
        return [
              'id' => $this->id,
              'sender' => UserResource::make($this->sender),
              'type' => $this->type,
              'message' => $this->message,
    ];
    }
}

<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class ContactUsResource extends JsonResource
{

    public function toArray($request)
    {
        return [
              'message_type'=>$this->message_type,
              'content'=>$this->content,
              'user_type'=>$this->user_type,
        ];
    }
}

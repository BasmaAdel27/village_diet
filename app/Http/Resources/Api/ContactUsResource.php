<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class ContactUsResource extends JsonResource
{

    public function toArray($request)
    {
        return [
              'full_name'=>$this->full_name,
              'email'=>$this->email,
              'message_type'=>$this->message_type,
              'title'=>$this->title,
              'content'=>$this->content,
              'user_type'=>$this->user_type,
        ];
    }

}

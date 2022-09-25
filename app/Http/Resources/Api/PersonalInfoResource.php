<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class PersonalInfoResource extends JsonResource
{

    public function toArray($request)
    {
        return [
              'first_name'=>$this->first_name,
              'last_name'=>$this->last_name,
              'email'=>$this->email,
              'phone'=>$this->phone,
              'user_number'=>$this->user_number,
        ];
    }
}

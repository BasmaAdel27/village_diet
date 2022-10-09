<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class ContactInfoResource extends JsonResource
{
    public function toArray($request)
    {
        return [
              'latitude'=>$this->latitude,
              'longitude'=>$this->longitude,
              'address'=>$this->address,
              'phone'=>$this->phone,
               'email' =>$this->email,
              'whatsapp_number'=>$this->whatsapp_number,
        ];
    }
}

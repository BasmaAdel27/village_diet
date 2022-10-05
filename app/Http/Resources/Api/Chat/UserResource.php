<?php

namespace App\Http\Resources\Api\Chat;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'  => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'type'=>$this->Roles[0]->name,
            'image' => $this->image
        ];
    }
}

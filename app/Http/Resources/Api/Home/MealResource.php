<?php

namespace App\Http\Resources\Api\Home;

use Illuminate\Http\Resources\Json\JsonResource;

class MealResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'breakfast' => $this->translate(app()->getLocale())->breakfast,
            'lunch' => $this->translate(app()->getLocale())->lunch,
            'dinner' => $this->translate(app()->getLocale())->dinner,
            'created_at' => $this->created_at
        ];
    }
}

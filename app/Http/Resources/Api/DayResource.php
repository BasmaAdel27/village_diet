<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class DayResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'number' => $this->number,
            'title' => $this->translate(app()->getLocale())->title,
        ];
    }
}

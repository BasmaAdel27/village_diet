<?php

namespace App\Http\Resources\Api\agenda;

use Illuminate\Http\Resources\Json\JsonResource;

class DaysResource extends JsonResource
{

    public function toArray($request)
    {
        return [
              'id' => $this->id,
              'number' => $this->number,
              'title' => $this->title,
        ];
    }
}

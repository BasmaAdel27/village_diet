<?php

namespace App\Http\Resources\Api\Home;

use Illuminate\Http\Resources\Json\JsonResource;

class SlideResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            'image' => url($this->image),
            "is_active" => (bool) $this->is_active,
            "link" => $this->link,
            "title" => $this->title,
            "description" => $this->description,
            "is_show_in_app" => (bool) $this->is_show_in_app,
            "created_at" => $this->created_at,
        ];
    }
}

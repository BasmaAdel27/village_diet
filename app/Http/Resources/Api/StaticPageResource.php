<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class StaticPageResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'content' => $this->content,
            'image' => $this->image
        ];
    }
}

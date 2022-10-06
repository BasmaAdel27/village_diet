<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class StaticPageResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'title' => $this->translate(app()->getLocale())->title,
            'content' => $this->translate(app()->getLocale())->content,
            'image' => $this->image
        ];
    }
}

<?php

namespace App\Http\Resources\Api\Home;

use Illuminate\Http\Resources\Json\JsonResource;

class VideoResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->translate(app()->getLocale())?->title,
            'video' => url($this->video_path),
            'thumbnail' => $this->thumbnail,
            'created_at' => $this->created_at
        ];
    }
}

<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'facebook' => $this->facebook,
            'twitter' => $this->twitter,
            'youtube' => $this->youtube,
            'snapchat' => $this->snapchat,
            'tiktok' => $this->tiktok,
            'instagram' => $this->instagram,
        ];
    }
}

<?php

namespace App\Http\Resources\Api;

use App\Http\Resources\Api\Home\MealResource;
use App\Http\Resources\Api\Home\SlideResource;
use App\Http\Resources\Api\Home\UserInfoResource;
use App\Http\Resources\Api\Home\VideoResource;
use Illuminate\Http\Resources\Json\JsonResource;

class HomeResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            // 'slides' => SlideResource::collection($this->slides),
            'health_info' => UserInfoResource::make($this->userInfo),
            'meal'  => MealResource::make($this->meal),
            'video'    => VideoResource::make($this->video),
            'society' => $this->society,
        ];
    }
}

<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class RatingResource extends JsonResource
{
    public function toArray($request)
    {
        $user = auth()->user();
        return [
            'trainer_name' => $this->resource ?
                $this->rateable?->first_name . ' ' . $this->rateable?->last_name :
                $user->society?->trainer?->first_name . ' ' . $user->society?->trainer?->last_name,
            'trainer_image' => $this->resource ?  $this->rateable?->image : $user->society?->trainer?->image,
            'rating' => $this->resource ?  $this->rating : null,
            'comment' => $this->resource ?  $this->comment : null,
        ];
    }
}

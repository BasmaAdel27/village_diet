<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Chat\TrainerMessageResource;
use App\Http\Resources\PaginationResource;
use App\Models\Chat\TrainerMessage;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function getTrainerMessages(Request $request)
    {
        $messages = TrainerMessage::where('citizen_id', auth()->id())
            ->where('trainer_id', auth()->user()?->society?->trainer->id)
            ->paginate($request->per_page);

        return successResponse(TrainerMessageResource::collection($messages), PaginationResource::make($messages));
    }
}

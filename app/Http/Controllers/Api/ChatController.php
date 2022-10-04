<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Chat\MessageResource;
use App\Http\Resources\Api\Chat\SocietyMessageResource;
use App\Http\Resources\Api\Chat\TrainerMessageResource;
use App\Http\Resources\PaginationResource;
use App\Models\Chat\AdminMessage;
use App\Models\Chat\SocietyChat;
use App\Models\Chat\TrainerMessage;
use App\Models\Society\Society;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use function PHPUnit\Framework\isEmpty;

class ChatController extends Controller
{
    public function getTrainerMessages(Request $request)
    {
        $receiver=$request->receiver_id;
        if (auth()->user()->society) {
            $messages = TrainerMessage::where([['sender_id', auth()->user()->id], ['receiver_id', $receiver]])
                  ->orWhere(function ($query) use ($receiver) {
                      return $query->where([['sender_id', $receiver], ['receiver_id', auth()->user()->id]]);
                  })->with('sender', 'receiver')->orderBy('created_at', 'asc')->get();
            if ($messages->isNotEmpty()) {
                return successResponse(MessageResource::collection($messages));
            } else {
                return failedResponse(Lang::get('no_messages'));
            }
        }
        return failedResponse(Lang::get('not_in_society'));
    }

    public function getAdminMessages(Request $request){
        $receiver=$request->receiver_id;
        $messages= AdminMessage::where([['sender_id', auth()->user()->id], ['receiver_id', $receiver]])
              ->orWhere(function ($query) use ($receiver) {
                  return $query->where([['sender_id', $receiver], ['receiver_id', auth()->user()->id]]);
              })->with('sender', 'receiver')->orderBy('created_at','asc')->get();
        if ($messages->isNotEmpty()) {
            return successResponse(MessageResource::collection($messages));
        }else{
            return failedResponse(Lang::get('no_messages'));

        }
    }


    public function getSocietyMessages(){
        $messages=SocietyChat::where('society_id',Auth::user()->society->id)->with('sender')->get();
        if ($messages->isNotEmpty()) {
            return successResponse(SocietyMessageResource::collection($messages));
        }else{
            return failedResponse(Lang::get('no_messages'));

        }
    }
}

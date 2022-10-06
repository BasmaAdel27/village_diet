<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\SocietyMessageRequest;
use App\Http\Requests\Api\StoreMessageRequest;
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
    public function getTrainerMessages()
    {
        if (auth()->user()->society) {

            $society=Society::find(\auth()->user()->society_id);
            $trainer=$society->trainer_id;

            $messages = TrainerMessage::where([['sender_id', auth()->user()->id], ['receiver_id', $trainer]])
                  ->orWhere(function ($query) use ($trainer) {
                      return $query->where([['sender_id', $trainer], ['receiver_id', auth()->user()->id]]);
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
        $messages=SocietyChat::where('society_id',Auth::user()->society->id)->with('sender.Roles')->get();
//      dd($messages);
        if ($messages->isNotEmpty()) {
            return successResponse(SocietyMessageResource::collection($messages));
        }else{
            return failedResponse(Lang::get('no_messages'));

        }
    }

    public function storeTrainerMessages(StoreMessageRequest $storeMessageRequest,TrainerMessage $trainerMessage){
        $data=$storeMessageRequest->validated();
        $trainerMessage->sender_id=\auth()->id();

        $trainerMessage->fill($data)->save();
        if ($storeMessageRequest->type == 'AUDIO'){
            $path = $storeMessageRequest->file("message")->storePublicly('chats/audios', "public");
            $audio =  "/storage/" . $path;
            $trainerMessage->message=$audio;
            $trainerMessage->save();
        }elseif ($storeMessageRequest->type == 'IMAGE'){
            $path = $storeMessageRequest->file("message")->storePublicly('chats/images', "public");
            $image =  "/storage/" . $path;
            $trainerMessage->message=$image;
            $trainerMessage->save();
        }
        return successResponse(MessageResource::make($trainerMessage),message: trans('message_sent_successfully'));

    }


    public function storeAdminMessages(StoreMessageRequest $storeMessageRequest,AdminMessage $adminMessage){
        $data=$storeMessageRequest->validated();
        $adminMessage->sender_id=\auth()->id();

        $adminMessage->fill($data)->save();

        if ($storeMessageRequest->type == 'AUDIO'){
            $path = $storeMessageRequest->file("message")->storePublicly('chats/audios', "public");
            $audio =  "/storage/" . $path;
            $adminMessage->message=$audio;
            $adminMessage->save();
        }elseif ($storeMessageRequest->type == 'IMAGE'){
            $path = $storeMessageRequest->file("message")->storePublicly('chats/images', "public");
            $image =  "/storage/" . $path;
            $adminMessage->message=$image;
            $adminMessage->save();
        }
        return successResponse(MessageResource::make($adminMessage),message: trans('message_sent_successfully'));

    }

    public function storeSocietyMessages(SocietyMessageRequest $societyMessageRequest,SocietyChat $societyChat){
        $societyMessageRequest->validated();
        $societyChat->sender_id=\auth()->id();
        $societyChat->society_id=\auth()->user()->society_id;
        $societyChat->type=$societyMessageRequest->type;


        if ($societyMessageRequest->type == 'AUDIO'){
            $path = $societyMessageRequest->file("message")->storePublicly('chats/audios', "public");
            $audio =  "/storage/" . $path;
            $societyChat->message=$audio;
            $societyChat->save();
        }elseif ($societyMessageRequest->type == 'IMAGE'){
            $path = $societyMessageRequest->file("message")->storePublicly('chats/images', "public");
            $image =  "/storage/" . $path;
            $societyChat->message=$image;
            $societyChat->save();
        }
        return successResponse(SocietyMessageResource::make($societyChat),message: trans('message_sent_successfully'));

    }


}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\SocietyMessageRequest;
use App\Http\Requests\Api\StoreMessageRequest;
use App\Http\Resources\Api\Chat\MessageResource;
use App\Http\Resources\Api\Chat\SocietyMessageResource;
use App\Http\Resources\PaginationResource;
use App\Models\Chat\AdminMessage;
use App\Models\Chat\SocietyChat;
use App\Models\Chat\TrainerMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class ChatController extends Controller
{
    public function getTrainerMessages(Request $request)
    {
        $userId = auth()->id();

        if (auth()->user()->society()->doesntExist())
            return failedResponse(Lang::get('not_in_society'));

        $trainerId = auth()->user()->society->trainer->id;

        $messages = TrainerMessage::with('sender', 'receiver')
            ->where(function ($q) use ($userId, $trainerId) {
                $q->where(['sender_id' => $userId, 'receiver_id' => $trainerId])
                    ->orWhere(['sender_id' => $trainerId, 'receiver_id' => $userId]);
            })
            ->latest()
            ->paginate($request->per_page ?? 15);

        return successResponse(MessageResource::collection($messages), PaginationResource::make($messages));
    }

    public function getAdminMessages(Request $request)
    {
        $receiver = $request->receiver_id;
        $messages = AdminMessage::where([['sender_id', auth()->id()], ['receiver_id', $receiver]])
            ->orWhere(function ($query) use ($receiver) {
                return $query->where([['sender_id', $receiver], ['receiver_id', auth()->id()]]);
            })->with('sender', 'receiver')->orderBy('created_at', 'asc')->get();
        if ($messages->isNotEmpty()) {
            return successResponse(MessageResource::collection($messages));
        } else {
            return failedResponse(Lang::get('no_messages'));
        }
    }


    public function getSocietyMessages()
    {
        $messages = SocietyChat::where('society_id', Auth::user()->society->id)->with('sender.Roles')->get();
        if ($messages->isNotEmpty()) {
            return successResponse(SocietyMessageResource::collection($messages));
        } else {
            return failedResponse(Lang::get('no_messages'));
        }
    }

    public function storeTrainerMessages(StoreMessageRequest $storeMessageRequest, TrainerMessage $trainerMessage)
    {
        $data = $storeMessageRequest->validated();
        $trainerMessage->sender_id = auth()->id();

        $trainerMessage->fill($data)->save();



        if ($storeMessageRequest->type == 'AUDIO') {
            $path = $storeMessageRequest->file("message")->storePublicly('chats/audios', "public");
            $audio =  "/storage/" . $path;
            $trainerMessage->message = $audio;
            $trainerMessage->save();
        } elseif ($storeMessageRequest->type == 'IMAGE') {
            $path = $storeMessageRequest->file("message")->storePublicly('chats/images', "public");
            $image =  "/storage/" . $path;
            $trainerMessage->message = $image;
            $trainerMessage->save();
        }

        
        return successResponse(MessageResource::make($trainerMessage), message: trans('message_sent_successfully'));
    }


    public function storeAdminMessages(StoreMessageRequest $storeMessageRequest, AdminMessage $adminMessage)
    {
        $data = $storeMessageRequest->validated();
        $adminMessage->sender_id = \auth()->id();

        $adminMessage->fill($data)->save();

        if ($storeMessageRequest->type == 'AUDIO') {
            $path = $storeMessageRequest->file("message")->storePublicly('chats/audios', "public");
            $audio =  "/storage/" . $path;
            $adminMessage->message = $audio;
            $adminMessage->save();
        } elseif ($storeMessageRequest->type == 'IMAGE') {
            $path = $storeMessageRequest->file("message")->storePublicly('chats/images', "public");
            $image =  "/storage/" . $path;
            $adminMessage->message = $image;
            $adminMessage->save();
        }
        return successResponse(MessageResource::make($adminMessage), message: trans('message_sent_successfully'));
    }

    public function storeSocietyMessages(SocietyMessageRequest $societyMessageRequest, SocietyChat $societyChat)
    {
        $societyMessageRequest->validated();
        $societyChat->sender_id = \auth()->id();
        $societyChat->society_id = \auth()->user()->society_id;
        $societyChat->type = $societyMessageRequest->type;


        if ($societyMessageRequest->type == 'AUDIO') {
            $path = $societyMessageRequest->file("message")->storePublicly('chats/audios', "public");
            $audio =  "/storage/" . $path;
            $societyChat->message = $audio;
            $societyChat->save();
        } elseif ($societyMessageRequest->type == 'IMAGE') {
            $path = $societyMessageRequest->file("message")->storePublicly('chats/images', "public");
            $image =  "/storage/" . $path;
            $societyChat->message = $image;
            $societyChat->save();
        }
        return successResponse(SocietyMessageResource::make($societyChat), message: trans('message_sent_successfully'));
    }
}

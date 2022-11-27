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
use App\Models\Society\Society;
use App\Models\User;
use App\Notifications\SendAdminNewMessage;
use App\Notifications\SendSocietyNewMessage;
use App\Notifications\SendTrainerNewMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Notification;


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
                  $q->where([['sender_id', $userId], ['receiver_id', $trainerId]])
                        ->orWhere([['sender_id', $trainerId], ['receiver_id', $userId]]);
              })->orderBy('created_at', 'desc')
              ->paginate($request->per_page ?? 15);

        return successResponse(MessageResource::collection($messages), PaginationResource::make($messages));
    }


    public function getAdminMessages(Request $request)
    {
        $userId = auth()->id();
        $adminsIds = User::whereHas('roles', fn($q) => $q->whereNotIn('name', ['user', 'trainer']))->pluck('id');

        $messages = AdminMessage::with('sender', 'receiver')
              ->where(function ($q) use ($userId, $adminsIds) {
                  $q->where(fn($q) => $q->where('sender_id', $userId)->whereIn('receiver_id', $adminsIds))
                        ->orWhere(fn($q) => $q->whereIn('sender_id', $adminsIds)->where('receiver_id', $userId));
              })
              ->orderBy('created_at', 'desc')
              ->paginate($request->per_page ?? 15);

        return successResponse(MessageResource::collection($messages), PaginationResource::make($messages));
    }

    public function getSocietyMessages(Request $request)
    {
        $messages = SocietyChat::query()
              ->where('society_id', auth()->user()->society?->id)
              ->with('sender.roles')
              ->orderBy('created_at', 'desc')
              ->paginate($request->per_page ?? 15);

        return successResponse(SocietyMessageResource::collection($messages), PaginationResource::make($messages));
    }

    public function storeTrainerMessages(StoreMessageRequest $storeMessageRequest, TrainerMessage $trainerMessage)
    {
        $trainerMessage->sender_id = auth()->id();
        $trainerMessage->fill($storeMessageRequest->validated())->save();
        $this->setMessageAttribute($trainerMessage);

        $receiver = User::find($storeMessageRequest->receiver_id);
        // send notification to delivery
        $title = 'Village Diet';
        $content = trans('u_receive_new_message');
        $message = [
              'data' => $trainerMessage
        ];
//        $this->saveNotification($storeMessageRequest->receiver_id);
        Notification::send($receiver, new SendTrainerNewMessage($trainerMessage));
        if ($receiver->firebase_token) {
            send_notification($receiver->firebase_token, $content, $title, $message);
        }

        return successResponse(MessageResource::make($trainerMessage), message: trans('message_sent_successfully'));
    }


    public function storeAdminMessages(StoreMessageRequest $storeMessageRequest, AdminMessage $adminMessage)
    {
        $adminMessage->sender_id = auth()->id();
        $adminMessage->fill($storeMessageRequest->validated())->save();
        $this->setMessageAttribute($adminMessage);
        $receiver = User::find($storeMessageRequest->receiver_id);
        // send notification to delivery
        $title = 'Village Diet';
        $content = trans('u_receive_new_message');
        $message = [
              'data' => $adminMessage
        ];
//        $this->saveNotification($storeMessageRequest->receiver_id);
        Notification::send($receiver, new SendAdminNewMessage($adminMessage));
        if ($receiver->firebase_token) {
            send_notification($receiver->firebase_token, $content, $title, $message);
        }

        return successResponse(MessageResource::make($adminMessage), message: trans('message_sent_successfully'));
    }

    public function storeSocietyMessages(SocietyMessageRequest $societyMessageRequest, SocietyChat $societyChat)
    {
        $societyChat->sender_id = auth()->id();
        $societyChat->society_id = auth()->user()->society_id;
        $societyChat->fill($societyMessageRequest->validated())->save();
        $society = Society::find($societyChat->society_id);
        $this->setMessageAttribute($societyChat);


        // send notification to delivery
        $title = 'Village Diet';
        $content = trans('u_receive_new_message');
        $message = [
              'data' => $societyChat
        ];
        foreach ($society->users->where('id', '<>', auth()->id()) as $user) {
//            $this->saveNotification($user->id);
            \Notification::send($user, new SendSocietyNewMessage($societyChat));
            if ($user->firebase_token) {
                send_notification($user->firebase_token, $content, $title, $message);
            }
        }
        return successResponse(SocietyMessageResource::make($societyChat), message: trans('message_sent_successfully'));
    }

    private function setMessageAttribute($model)
    {
        if ($model->type != 'TEXT') {
            $path = $model->message->storePublicly('chats/media', "public");
            $model->update(['message' => "/storage/" . $path]);
        }
    }

    public function saveNotification($id)
    {
        $data['id'] = Str::uuid();
        $data['type'] = 'chat';
        $data['notifiable_id'] = $id;
        $data['notifiable_type'] = User::class;
        $data['data']['type'] = 'chat';
        $data['data']['title'] = trans('mobile.notifications.content.new_message', locale: 'en');
        $data['data']['title_ar'] = trans('mobile.notifications.content.new_message', locale: 'ar');
        $data['data']['body'] = trans('u_receive_new_message', locale: 'en');
        $data['data']['body_ar'] = trans('u_receive_new_message', locale: 'ar');
        DatabaseNotification::create($data);
    }
}

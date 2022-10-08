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

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Spatie\Permission\Models\Role;
use function PHPUnit\Framework\isEmpty;


class ChatController extends Controller
{

    private function setMessageAttribute($model)
    {

        if ($model->type == 'AUDIO' || $model->type == 'IMAGE') {
//            dd('gg');
            $path = $model->message->storePublicly('chats/media', "public");
            $data = "/storage/" . $path;
            return $data;
        }else {
            return $model->message;
        }


    }

    public function getTrainerMessages(Request $request)
    {
        $userId = auth()->id();

        if (auth()->user()->society()->doesntExist())
            return failedResponse(Lang::get('not_in_society'));

        $trainerId = auth()->user()->society->trainer->id;

        $messages = TrainerMessage::with('sender', 'receiver')
              ->where(function ($q) use ($userId, $trainerId) {
                  $q->where([['sender_id', $userId], ['receiver_id', $trainerId]])
                        ->orWhere([['sender_id', $trainerId], ['receiver_id' , $userId]]);
              })->orderBy('created_at','asc')
              ->paginate($request->per_page ?? 15);


        return successResponse(MessageResource::collection($messages), PaginationResource::make($messages));
    }


    public function getAdminMessages(Request $request)
    {
        $userId = \auth()->id();
        $roles = Role::whereNotIn('name', ['user', 'trainer'])->get();
        $admins = [];
        foreach ($roles as $role) {
            $admins = DB::table('user_has_roles')->select('user_has_roles.*')
                  ->where('user_has_roles.role_id', $role->id)
                  ->join('users', 'user_has_roles.model_id', '=', 'users.id')
                  ->get();
        }
        $messages = [];
        foreach ($admins as $admin) {
            $messages = AdminMessage::with('sender', 'receiver')
                  ->where(function ($q) use ($userId, $admin) {
                      $q->where([['sender_id', $userId], ['receiver_id', $admin->model_id]])
                            ->orWhere([['sender_id', $admin->model_id], ['receiver_id', $userId]]);
                  })->orderBy('created_at', 'asc')
                  ->paginate($request->per_page ?? 15);

        }
        if ($messages->isNotEmpty()) {
            return successResponse(MessageResource::collection($messages), PaginationResource::make($messages));
        } else {
            return failedResponse(Lang::get('no_messages'));
        }
    }





    public function getSocietyMessages(){
        $messages=SocietyChat::where('society_id',Auth::user()->society->id)
              ->with('sender.Roles')->orderBy('created_at','asc')
              ->paginate($request->per_page ?? 15);
        if ($messages->isNotEmpty()) {
            return successResponse(SocietyMessageResource::collection($messages),PaginationResource::make($messages));
        }else{
            return failedResponse(Lang::get('no_messages'));
        }
    }

    public function storeTrainerMessages(StoreMessageRequest $storeMessageRequest, TrainerMessage $trainerMessage)
    {
        $data = $storeMessageRequest->validated();
        $trainerMessage->sender_id = auth()->id();
        $trainerMessage->fill($data)->save();
        $trainerMessage->message= $this->setMessageAttribute($trainerMessage);


        return successResponse(MessageResource::make($trainerMessage),message: trans('message_sent_successfully'));

    }


    public function storeAdminMessages(StoreMessageRequest $storeMessageRequest, AdminMessage $adminMessage)
    {
        $data = $storeMessageRequest->validated();
        $file=$storeMessageRequest->file('message');
        $adminMessage->sender_id = \auth()->id();
        $adminMessage->fill($data)->save();
       $adminMessage->message= $this->setMessageAttribute($adminMessage);


        return successResponse(MessageResource::make($adminMessage),message: trans('message_sent_successfully'));

    }

    public function storeSocietyMessages(SocietyMessageRequest $societyMessageRequest,SocietyChat $societyChat)
    {
        $data = $societyMessageRequest->validated();
        $societyChat->sender_id = \auth()->id();
        $societyChat->society_id = \auth()->user()->society_id;
        $societyChat->type = $societyMessageRequest->type;
        $societyChat->fill($data)->save();
        $societyChat->message= $this->setMessageAttribute($societyChat);


        return successResponse(SocietyMessageResource::make($societyChat), message: trans('message_sent_successfully'));

    }

}

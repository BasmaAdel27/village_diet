<?php

namespace App\Models\Chat;

use App\Models\User;
use App\Models\Chat\AdminChat;
use Illuminate\Database\Eloquent\Model;

class AdminMessage extends Model
{
    public $guarded = [];



    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
    public function setMessageAttribute($value)
    {
        $path = $value->storePublicly('chats/media', "public");
        $data = "/storage/" . $path;
        $this->attributes['message'] = $data;


    }
}

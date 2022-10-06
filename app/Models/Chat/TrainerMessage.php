<?php

namespace App\Models\Chat;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class TrainerMessage extends Model
{
    public $guarded = [];


    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
    public function setMessageAttribute($value)
    {
        if ($this->attributes['type'] == 'AUDIO' || $this->attributes['type'] == 'IMAGE') {
            $path = $value->storePublicly('chats/media', "public");
            $data = "/storage/" . $path;
            $this->attributes['message'] = $data;
        }else {
            $this->attributes['message'] = $value;
        }


       }


}

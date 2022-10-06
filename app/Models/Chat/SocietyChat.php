<?php

namespace App\Models\Chat;

use App\Models\Society\Society;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class SocietyChat extends Model
{
    protected $table = 'society_messages';
    public $guarded = [];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function society()
    {
        return $this->belongsTo(Society::class, 'society_id');
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

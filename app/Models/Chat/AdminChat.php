<?php

namespace App\Models\Chat;

use App\Models\User;
use App\Models\Chat\AdminChatMessage;
use Illuminate\Database\Eloquent\Model;

class AdminChat extends Model
{
    public $guarded = [];

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function messages()
    {
        return $this->hasMany(AdminChatMessage::class);
    }

    public function lastMessage()
    {
        return $this->hasOne(AdminChatMessage::class)->latestOfMany();
    }
}

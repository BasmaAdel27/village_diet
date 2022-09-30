<?php

namespace App\Models\Chat;

use App\Models\User;
use App\Models\Chat\ChatMessage;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    public $guarded = [];

    public function trainer()
    {
        return $this->belongsTo(User::class, 'trainer_id');
    }

    public function citizen()
    {
        return $this->belongsTo(User::class, 'citizen_id');
    }

    public function messages()
    {
        return $this->hasMany(ChatMessage::class);
    }

    public function lastMessage()
    {
        return $this->hasOne(ChatMessage::class)->latestOfMany();
    }
}

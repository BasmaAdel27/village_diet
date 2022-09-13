<?php

namespace App\Models\Chat;

use App\Models\User;
use App\Models\Chat\ChatMessage;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    public $guarded = [];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
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

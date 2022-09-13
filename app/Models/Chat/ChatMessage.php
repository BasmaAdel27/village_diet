<?php

namespace App\Models\Chat;

use App\Models\User;
use App\Models\Chat\Chat;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    public $guarded = [];

    public $touches = ['chat'];

    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}

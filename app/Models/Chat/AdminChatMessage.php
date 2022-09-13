<?php

namespace App\Models\Chat;

use App\Models\User;
use App\Models\Chat\AdminChat;
use App\Enums\Chat\ChatMessageEnum;
use Illuminate\Database\Eloquent\Model;

class AdminChatMessage extends Model
{
    public $guarded = [];

    public $touches = ['chat'];

    protected $casts = [
        'type' => ChatMessageEnum::class,
    ];

    public function chat()
    {
        return $this->belongsTo(AdminChat::class);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}

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

}

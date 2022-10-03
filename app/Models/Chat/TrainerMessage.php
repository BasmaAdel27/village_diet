<?php

namespace App\Models\Chat;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class TrainerMessage extends Model
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
}

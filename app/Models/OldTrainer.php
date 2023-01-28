<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OldTrainer extends Model
{
    use HasFactory;

    protected $casts = ['trainers' => 'array'];

    protected $fillable = ['trainers'];
}

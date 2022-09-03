<?php

namespace App\Models\Day;

use Illuminate\Database\Eloquent\Model;

class DayTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['title'];
}

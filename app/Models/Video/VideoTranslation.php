<?php

namespace App\Models\Video;

use Illuminate\Database\Eloquent\Model;

class VideoTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['title'];
}

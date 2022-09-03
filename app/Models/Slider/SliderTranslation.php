<?php

namespace App\Models\Slider;

use Illuminate\Database\Eloquent\Model;

class SliderTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['title', 'description'];
}

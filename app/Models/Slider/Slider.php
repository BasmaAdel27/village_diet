<?php

namespace App\Models\Slider;

use App\Traits\HasTimestampTrait;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;


class Slider extends Model implements TranslatableContract
{
    use HasFactory, HasTimestampTrait, Translatable;

    public $translatedAttributes = ['title', 'description'];
    protected $fillable = [
        'is_active',
        'link',
        'is_show_in_app',
    ];
}

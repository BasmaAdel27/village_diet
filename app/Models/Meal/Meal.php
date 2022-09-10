<?php

namespace App\Models\Meal;

use App\Models\Day\Day;
use App\Traits\HasTimestampTrait;
use Astrotomic\Translatable\Contracts\Translatable;
use Astrotomic\Translatable\Translatable as TranslatableTranslatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model implements Translatable
{
    use HasFactory, TranslatableTranslatable, HasTimestampTrait;


    public $translatedAttributes = ['breakfast', 'lunch', 'dinner'];
    protected $guarded = [];

    public function day()
    {
        return $this->belongsTo(Day::class);
    }
}

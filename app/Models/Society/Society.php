<?php

namespace App\Models\Society;

use App\Traits\HasTimestampTrait;
use Astrotomic\Translatable\Contracts\Translatable;
use Astrotomic\Translatable\Translatable as TranslatableTranslatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Society extends Model implements Translatable
{
    use HasFactory, TranslatableTranslatable, HasTimestampTrait;

    public $translatedAttributes = ['title'];
    protected $guarded = [];
}

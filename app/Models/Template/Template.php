<?php

namespace App\Models\Template;

use App\Traits\HasTimestampTrait;
use Astrotomic\Translatable\Contracts\Translatable;
use Astrotomic\Translatable\Translatable as TranslatableTranslatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model implements Translatable
{
    use HasFactory, TranslatableTranslatable, HasTimestampTrait;

    protected $guarded = [];
    public $translatedAttributes = ['subject', 'content'];
}

<?php

namespace App\Models\Faq;

use App\Traits\HasTimestampTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Faq extends Model implements TranslatableContract
{
    use HasFactory, Translatable, HasTimestampTrait;


    public $translatedAttributes = ['question', 'answer'];
    protected $guarded = [];
}

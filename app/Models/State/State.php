<?php

namespace App\Models\State;

use App\Traits\HasTimestampTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class State extends Model implements TranslatableContract
{
    use HasFactory, Translatable, HasTimestampTrait;

    protected $guarded = ['created_at'];
    public $translatedAttributes = ['name'];
    public $with = ['translations'];
}

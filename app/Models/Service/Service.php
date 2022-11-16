<?php

namespace App\Models\Service;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use App\Traits\HasTimestampTrait;

class Service extends Model implements TranslatableContract
{
    use HasFactory, Translatable, HasTimestampTrait;

    public $translatedAttributes = ['title', 'description'];
    protected $fillable = [
        'is_active',
        'ordering',
    ];
}

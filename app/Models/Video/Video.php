<?php

namespace App\Models\Video;

use App\Traits\HasAssetsTrait;
use App\Traits\HasTimestampTrait;
use Astrotomic\Translatable\Contracts\Translatable;
use Astrotomic\Translatable\Translatable as TranslatableTranslatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class video extends Model implements Translatable
{
    use HasFactory, TranslatableTranslatable, HasTimestampTrait, HasAssetsTrait;

    protected $guarded = [];
    public $translatedAttributes = ['title'];
    public $assets = ['video'];

    public static function boot()
    {
        parent::boot();
        static::saved(function ($model) {
            $model->saveAssets($model, request());
        });
    }
}

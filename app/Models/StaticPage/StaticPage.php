<?php

namespace App\Models\StaticPage;

use App\Traits\HasAssetsTrait;
use App\Traits\HasTimestampTrait;
use Astrotomic\Translatable\Contracts\Translatable;
use Astrotomic\Translatable\Translatable as TranslatableTranslatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaticPage extends Model implements Translatable
{
    use HasFactory, TranslatableTranslatable, HasTimestampTrait, HasAssetsTrait;

    protected $guarded = [];
    public $translatedAttributes = ['title', 'content'];
    public $assets = ['image'];

    public static function boot()
    {
        parent::boot();
        static::saved(function ($model) {
            $model->saveAssets($model, request());
        });
    }
}

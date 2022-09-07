<?php

namespace App\Models\Slider;

use App\Traits\HasAssetsTrait;
use App\Traits\HasTimestampTrait;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;


class Slider extends Model implements TranslatableContract
{
    use HasFactory, HasAssetsTrait, HasTimestampTrait, Translatable;

    public $translatedAttributes = ['title', 'description'];
    protected $fillable = [
        'is_active',
        'link',
        'is_show_is_app',
    ];
    public $assets = ['image'];

    public static function boot()
    {
        parent::boot();
        static::saved(function ($model) {
            $model->saveAssets($model, request());
        });
    }
}

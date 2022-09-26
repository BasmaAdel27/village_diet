<?php

namespace App\Models\Video;

use App\Models\Day\Day;
use App\Traits\HasAssetsTrait;
use App\Traits\HasTimestampTrait;
use Astrotomic\Translatable\Contracts\Translatable;
use Astrotomic\Translatable\Translatable as TranslatableTranslatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model implements Translatable
{
    use HasFactory, TranslatableTranslatable, HasTimestampTrait, HasAssetsTrait;

    protected $fillable = ['is_active', 'day_id'];
    public $translatedAttributes = ['title'];
    public $assets = ['video'];

    public static function boot()
    {
        parent::boot();
        static::saved(function ($model) {
            $model->saveAssets($model, request());
        });
    }

    public function day()
    {
        return $this->belongsTo(Day::class);
    }

    public function getVideoPathAttribute()
    {
        return $this->images()->where('option', 'video')->value('media');
    }
}

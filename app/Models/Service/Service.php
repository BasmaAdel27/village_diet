<?php

namespace App\Models\Service;

use App\Traits\HasAssetsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use App\Traits\HasTimestampTrait;

class Service extends Model implements TranslatableContract
{
    use HasFactory, Translatable, HasTimestampTrait, HasAssetsTrait;

    public $translatedAttributes = ['title', 'description'];
    protected $fillable = [
        'is_active',
        'ordering',
    ];

    public $assets = ['image'];

    public static function boot()
    {
        parent::boot();
        static::saved(function ($model) {
            $model->saveAssets($model, request());
        });
    }

    public function getImageAttribute()
    {
        return $this->images()->where('option', 'image')->value('media');
    }
}

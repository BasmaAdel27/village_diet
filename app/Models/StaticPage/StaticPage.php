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

    protected $fillable = ['is_active', 'is_show_in_app'];
    public $translatedAttributes = ['title', 'content'];
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
        return ($this->images()->whereOption('image')->value('media') != null) ?
            asset($this->images()->whereOption('image')->value('media')) :
            asset('website/assets/images/logo/logo.svg');
    }
}

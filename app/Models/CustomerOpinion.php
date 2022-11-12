<?php

namespace App\Models;

use App\Traits\HasAssetsTrait;
use App\Traits\HasTimestampTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerOpinion extends Model
{
    use HasFactory ,HasAssetsTrait ,HasTimestampTrait;
    protected $fillable =['name','content'];
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
        if ($this->images()->whereOption('image')->value('media')) {
            return asset($this->images()->whereOption('image')->value('media'));
        }

    }

}

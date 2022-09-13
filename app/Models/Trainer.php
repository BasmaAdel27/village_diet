<?php

namespace App\Models;

use App\Models\Society\Society;
use App\Traits\HasAssetsTrait;
use App\Traits\HasTimestampTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    use HasFactory, HasAssetsTrait ,HasTimestampTrait;

    public $assets = ['confidental_image'];
    public $files = ['cv'];
    protected $guarded = [];

    const PENDING  = 'PENDING';
    const DONE     = 'DONE';
    const DECLINED ='DECLINED';
    const STATUSES = [self::PENDING, self::DONE, self::DECLINED];

    public static function boot()
    {
        parent::boot();
        static::saved(function ($model) {
            $model->saveAssets($model, request());
        });
    }

    public function societies(){
        return $this->hasMany(Society::class);
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

}

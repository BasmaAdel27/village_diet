<?php

namespace App\Models;

use App\Traits\HasAssetsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    use HasFactory, HasAssetsTrait;

    public $assets = ['confidental_image'];
    public $files = ['cv'];
    protected $guarded = [];

    const PENDING  = 'PENDING';
    const DONE     = 'DONE';
    const STATUSES = [self::PENDING, self::DONE];

    public static function boot()
    {
        parent::boot();
        static::saved(function ($model) {
            $model->saveAssets($model, request());
        });
    }
}

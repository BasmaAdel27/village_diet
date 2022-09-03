<?php

namespace App\Models\StaticPage;

use Illuminate\Database\Eloquent\Model;

class StaticPageTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['title', 'content'];
}

<?php

namespace App\Models\Template;

use Illuminate\Database\Eloquent\Model;

class TemplateTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['subject', 'content'];
}

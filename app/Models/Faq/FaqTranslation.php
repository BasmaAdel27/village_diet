<?php

namespace App\Models\Faq;

use Illuminate\Database\Eloquent\Model;

class FaqTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['question', 'answer'];
}

<?php

namespace App\Models\Society;

use App\Models\Trainer;
use App\Models\User;
use App\Traits\HasTimestampTrait;
use Astrotomic\Translatable\Contracts\Translatable;
use Astrotomic\Translatable\Translatable as TranslatableTranslatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Society extends Model implements Translatable
{
    use HasFactory, TranslatableTranslatable, HasTimestampTrait;

    public $translatedAttributes = ['title'];
    protected $fillable = ['is_active', 'date_from', 'trainer_id'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_societies');
    }

    public function trainer()
    {
        return $this->belongsTo(User::class);
    }
}

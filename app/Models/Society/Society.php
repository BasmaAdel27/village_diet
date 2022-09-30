<?php

namespace App\Models\Society;

use App\Models\Chat\SocietyChat;
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
        return $this->hasMany(User::class);
    }

    public function trainer()
    {
        return $this->belongsTo(User::class);
    }

    public function messages()
    {
        return $this->hasMany(SocietyChat::class, 'society_id');
    }
}

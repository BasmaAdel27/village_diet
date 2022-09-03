<?php

namespace App\Models\Meal;

use Illuminate\Database\Eloquent\Model;

class MealTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['braakfast', 'lunch', 'dinner'];
}

<?php

namespace App\Models;

use App\Traits\HasTimestampTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory, HasTimestampTrait;

    protected $guarded = [];

    const FIXED = 'fixed';
    const  PERCENT = 'percent';
    const COUPON_TYPES = [self::FIXED, self::PERCENT];

    public function getActivateDateAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d');
    }

    public function getEndDateAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d');
    }
}

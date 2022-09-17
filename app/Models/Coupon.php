<?php

namespace App\Models;

use App\Traits\HasTimestampTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory,HasTimestampTrait;

    protected $guarded = [];
    const DONE = 'done';
    const  PERCENT= 'percent';
    const COUPON_TYPES = [self::DONE, self::PERCENT];
}
